<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Mercadolibrepreguntas\Models\Mercadolibrepregunta;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Mercadolibrepregunta::class)
            ->selectFields($request->input('fields.mercadolibrepreguntas'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Mercadolibrepregunta $mercadolibrepregunta, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($mercadolibrepregunta->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $mercadolibrepregunta->setTranslation($key, $lang, $value);
                }
            } else {
                $mercadolibrepregunta->{$key} = $content;
            }
        }

        $mercadolibrepregunta->save();
    }

    public function destroy(Mercadolibrepregunta $mercadolibrepregunta)
    {
        $mercadolibrepregunta->delete();
    }

    // || ---------------------------------------------------------------------------------------- || //

    /*
        Querido Meli: POR FAVOR, ALGUN DÍA TRANSFORMA TU DOCUMENTACIÓN EN UNA DOCUMENTACIÓN Y NO
        EN UN ABSURDO Y VACÍO PALABRERIO SIN SENTIDO. Muchas Gracias.


        ****************************************************************************************************************************
        UTIL:
            Root api: ttps://api.mercadolibre.com/sites/MLA/


        ******************************
        * Generación de access Token *
        ******************************

        * Primero, autentificar:
            https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id={$APP_ID}[&redirect_uri=$YOUR_URL]            
            [] => en caso de tener configurada un redirect uri al registrar la app en el dev center.

            Ejemplo:
                https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=4214006257775007&redirect_uri=https://google.com.ar

            -----------------------------------------------------------------------------------------------------
            ¿Que es eso del $APP_ID y como lo consigo?
            -----------------------------------------------------------------------------------------------------
            La primera parte de la pregunta no va a ser contestada, la segunda si:
                Ingresar al dev center -> mis aplicaciones -> Vas a poder ver las aplicaciones registradas,
                en sus recuadros hay un ID, ese mismo es el $APP_ID.
            Ejemplo: ID: 4214006257775007.
            -----------------------------------------------------------------------------------------------------

            Esto debe ser ejecutado en un navegador; coloquese la url fabricada en el mismo.

        * Permitir acceso:
            Se abrirá una ventana en la cual se pregunará si se desea conceder el acceso al usuario (aplicación). 
            Permitase.

        * Que pasa despues:
            Una vez permitido el acceso, cada vez que peguemos el url del ejemplo primero, sera redirigido el navegador
            al sitio registrado como callback_uri o uri de redirección con el refresh token como query param:
            
            Ejemplo:    
                https://www.google.com.ar/?[code=TG-624483094e46fc001afc4800-1047842538]
                https://www.google.com.ar/?[code=TG-62448ba4aa0eb8001a1e3309-1047842538]
            [] => _AUTH TOKEN_

        * Obtener el access Token:
            Hacer un post request a esta url con los siguientes parametros:
                https://api.mercadolibre.com/oauth/token
                ?grant_type=authorization_code
                &client_id=4214006257775007 || APP ID
                &client_secret=MPV89CEAsHtRZ6OVofLfzok03pndEz9e || CLIENT SECRET
                &code=TG-624493204e46fc001afc6226-1047842538 || _AUTH TOKEN_
                &redirect_uri=https://google.com.ar

                Response:
                        "access_token": "APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538",
                        "token_type": "bearer",
                        "expires_in": 21600,
                        "scope": "offline_access read write",
                        "user_id": 1047842538,
                        "refresh_token": "TG-6244932cae06ea001bddedb3-1047842538"

        Y listo, ya tenemos un Access Token. No se olviden de darle a la campanita, me gusta y suscribir.
        ****************************************************************************************************************************

        ****************************************************************************************************************************
        
        ******************************
        * Obtención del SELLER ID *
        ******************************
            || La forma mas facil que hallé es la siguiente ||

            * Primero:
                Buscar nickname del vendedor, para eso acceder a la cuenta -> Mis datos -> Usuario = NICKNAME: 'NUEVALIBRERIASRL'.

                Ejemplo: https://api.mercadolibre.com/sites/MLA/search?nickname=NUEVALIBRERIASRL

            * Resultado:
                "seller": {
                    "id": 303551670, [|| Este de acá es el SELLER_ID ||]
                    "nickname": "NUEVALIBRERIASRL",
                    "permalink": "http://perfil.mercadolibre.com.ar/NUEVALIBRERIASRL",
                    "registration_date": "2018-02-21T17:43:12.000-04:00",
                    "seller_reputation": {},
                    "real_estate_agency": false,
                    "car_dealer": false,
                    "tags": [],
                    "eshop": null
                }
        ****************************************************************************************************************************


        Para obtener la info de un producto:
            https://api.mercadolibre.com/items/MLA{itemID}

        Para listar las publicaciones del vendedor:
            https://api.mercadolibre.com/users/{$USER_ID}/items/search
                https://api.mercadolibre.com/users/303551670/items/search

            https://api.mercadolibre.com/sites/MLA/search?seller_id=303551670


        
        || DATOS IMPORTANTES Y CONFIDENCIALES ||
            SELLER ID: 303551670
            SELLER ID: PRUEBAS: 
            APP ID: 4214006257775007
            ACCESS TOKEN: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538

        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Como obtener los items de la cuenta del vendedor (publicos y privados):
                Request a: https://api.mercadolibre.com/users/$USER_ID/items/search
                Con headers (Bearer: $ACCESS_TOKEN)
            Ejemplo:
                https://api.mercadolibre.com/users/303551670/items/search
                Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
            Response:
                "seller_id": "1047842538",
                "query": null,
                "paging": {
                    "limit": 50,
                    "offset": 0,
                    "total": 2
                },
                "results": [
                    "MLA1127551700", || Publicacion del vendedor
                    "MLA1129973584"  || Publicacion del vendedor
                ],
        
        || Items publicos de un vendedor:
            Request a: 
                https://api.mercadolibre.com/sites/$SITE_ID/search?seller_id=$SELLER_ID

            Ejemplo:
                https://api.mercadolibre.com/sites/MLA/search?seller_id=303551670
            
            Response:
                "paging": {
                    "total": 2,
                    "primary_results": 0,
                    "offset": 0,
                    "limit": 50
                },
                "results": [
                    "MLA1127551700", || Publicacion del vendedor
                    "MLA1129973584"  || Publicacion del vendedor
                ],

   
        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Para obtener las preguntas en una determinada publicación:
                Hacer request a:
                    https://api.mercadolibre.com/questions/search?item_id=$ITEM_ID
                Con headers (Bearer: $ACCESS_TOKEN)

                Ejemplo:
                    https://api.mercadolibre.com/questions/search?item_id=MLA1129973584
                    Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
                Response:
                    {
                        "total": 7,
                        "limit": 50,
                        "questions": [
                          {
                            "date_created": "2022-03-29T14:49:07.817-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Buenisimo! Ahora la compro, podrás embalarla bien? Porque va con envio para Bahia Blanca",
                            "id": 12297208947,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-29T05:11:09.104-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Hola! Todavía la tenés? Te sirven $18000? Gracias",
                            "id": 12296634579,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-28T16:17:29.634-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Y la pones en cuotas sin interés te la compro ya. (A vos te la dan todo junta)",
                            "id": 12296110098,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-28T16:16:49.491-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "No no, a vos la plata te la dan al contado. Pero yo le voy pagando en cuotas a mercado libre. (Pero a vos te la dan al contado)",
                            "id": 12296106910,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-28T16:13:22.823-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Es la drr5? Tenes publicación en cuotas?",
                            "id": 12296103462,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-27T19:20:29.572-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Viene cerrada en su caja?",
                            "id": 12295139946,
                            "answer": {}
                          },
                          {
                            "date_created": "2022-03-27T18:56:21.430-04:00",
                            "item_id": "MLA1127551700",
                            "seller_id": 1047842538,
                            "status": "ANSWERED",
                            "text": "Buenas! Con que procesador me recomendarías esta grafica?",
                            "id": 12295120507,
                            "answer": {}
                          }
                        ],
                        "filters": {
                          "limit": 50,
                          "offset": 0,
                          "api_version": "4",
                          "is_admin": false,
                          "sorts": [
                          ],
                          "caller": null,
                          "item": "MLA1127551700"
                        },
                        "available_filters": [
                          {},
                          {},
                          {},
                          {},
                          {}
                        ],
                        "available_sorts": [
                          "item_id",
                          "from_id",
                          "date_created",
                          "seller_id"
                        ]
                    }

        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Para obtener informacion detallada de una pregunta en particular
            Get Request a:
                https://api.mercadolibre.com/questions/$IDPREGUNTA
                Con headers (Bearer: $ACCESS_TOKEN)
            Ejemplo:
                https://api.mercadolibre.com/questions/12297208947
                Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
            Response:
                    {
                        "id": 12297208947,
                        "seller_id": 1047842538,
                        "text": "Buenisimo! Ahora la compro, podrás embalarla bien? Porque va con envio para Bahia Blanca",
                        "status": "ANSWERED",
                        "item_id": "MLA1127551700",
                        "date_created": "2022-03-29T14:49:07.817-04:00",
                        "hold": false,
                        "deleted_from_listing": false,
                        "answer": {
                            "text": "Dale, procuro embalarla bien! Si el correo sigue abierto para cuando la compres intento despacharla hoy mismo, sino mañana!",
                            "status": "ACTIVE",
                            "date_created": "2022-03-29T15:16:45.296-04:00"
                        },
                        "from": {
                            "id": 582346097,
                            "answered_questions": 2
                        }
                    }                       
        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Para responder a una pregunta:
            Post Request a:
                https://api.mercadolibre.com/answers
                Con headers (Bearer: $ACCESS_TOKEN)
                Con parametros:
                    question_id = $QUESTIONID,
                    text = $RESPUESTA
                
            Ejemplo:
                    axios.post('https://api.mercadolibre.com/answers', {
                        question_id: '12297208947',
                        text: 'Sisi dale, lo embalo.'
                    }).then((response) => {

                    })
            Response:
                    {
                        "id": 3957150025,
                        "answer": {
                        	"date_created": "2016-02-29T11:21:27.831-04:00",
                        	"status": "ACTIVE",
                        	"text": "Sisi dale, lo embalo."
                        },
                        "date_created": "2016-02-29T11:19:42.000-04:00",
                        "deleted_from_listing": false,
                        "hold": false,
                        "item_id": "MLA608007087",
                        "seller_id": 1047842538,
                        "status": "ANSWERED",
                        "text": "Buenisimo! Ahora la compro, podrás embalarla bien? Porque va con envio para Bahia Blanca",
                        "from": {
                        	"id": 12297208947,
                        	"answered_questions": 0
                        }
                    }
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Para obtener los pedidos realizados al vendedor:
            Hacer get request a:
                https://api.mercadolibre.com/orders/search?seller=$SELLER_ID
                Con Bearer: $ACCESS_TOKEN
            Ejemplo:
                https://api.mercadolibre.com/orders/search?seller=303551670
                Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
            Response:
                {
                    "query": "",
                    "results": [
                        {
                            "payments": [
                                {
                                    "reason": "Rx 550 2gb",
                                    "status_code": null,
                                    "total_paid_amount": 18000,
                                    "operation_type": "regular_payment",
                                    "transaction_amount": 18000,
                                    "transaction_amount_refunded": 0,
                                    "date_approved": "2022-03-29T19:15:51.000-04:00",
                                    "collector": {
                                        "id": 1047842538
                                    },
                                    "coupon_id": null,
                                    "installments": 1,
                                    "authorization_code": null,
                                    "taxes_amount": 0,
                                    "id": 21210669252,
                                    "date_last_modified": "2022-03-29T19:17:51.000-04:00",
                                    "coupon_amount": 0,
                                    "available_actions": [
                                        "refund"
                                    ],
                                    "shipping_cost": 0,
                                    "installment_amount": null,
                                    "date_created": "2022-03-29T19:15:51.000-04:00",
                                    "activation_uri": null,
                                    "overpaid_amount": 0,
                                    "card_id": null,
                                    "status_detail": "accredited",
                                    "issuer_id": null,
                                    "payment_method_id": "account_money",
                                    "payment_type": "account_money",
                                    "deferred_period": null,
                                    "atm_transfer_reference": {
                                        "transaction_id": null,
                                        "company_id": null
                                    },
                                    "site_id": "MLA",
                                    "payer_id": 582346097,
                                    "order_id": 5369483786,
                                    "currency_id": "ARS",
                                    "status": "approved",
                                    "transaction_order_id": null
                                }
                            ],
                            "fulfilled": null,
                            "taxes": {
                                "amount": null,
                                "currency_id": null,
                                "id": null
                            },
                            "order_request": {
                                "change": null,
                                "return": null
                            },
                            "expiration_date": "2022-04-26T19:15:52.000-04:00",
                            "feedback": {
                                "buyer": null,
                                "seller": null
                            },
                            "shipping": {
                                "id": 41274753327
                            },
                            "date_closed": "2022-03-29T19:15:52.000-04:00",
                            "id": 5369483786,
                            "manufacturing_ending_date": null,
                            "order_items": [
                                {
                                    "item": {
                                        "id": "MLA1127551700",
                                        "title": "Rx 550 2gb",
                                        "category_id": "MLA1658",
                                        "variation_id": null,
                                        "seller_custom_field": null,
                                        "global_price": null,
                                        "net_weight": null,
                                        "variation_attributes": [],
                                        "warranty": "Sin garantía",
                                        "condition": "new",
                                        "seller_sku": null
                                    },
                                    "quantity": 1,
                                    "unit_price": 18000,
                                    "full_unit_price": 18000,
                                    "currency_id": "ARS",
                                    "manufacturing_days": null,
                                    "picked_quantity": null,
                                    "requested_quantity": {
                                        "measure": "unit",
                                        "value": 1
                                    },
                                    "sale_fee": 0,
                                    "listing_type_id": "free",
                                    "base_exchange_rate": null,
                                    "base_currency_id": null,
                                    "bundle": null,
                                    "element_id": null
                                }
                            ],
                            "date_last_updated": "2022-03-30T13:35:04+00:00",
                            "last_updated": "2022-03-29T19:17:52.000-04:00",
                            "comment": null,
                            "pack_id": null,
                            "coupon": {
                                "amount": 0,
                                "id": null
                            },
                            "shipping_cost": null,
                            "date_created": "2022-03-29T19:15:50.000-04:00",
                            "pickup_id": null,
                            "status_detail": null,
                            "tags": [
                                "not_delivered",
                                "paid"
                            ],
                            "buyer": {
                                "id": 582346097,
                                "nickname": "VALENTINMASSETTI"
                            },
                            "seller": {
                                "id": 1047842538,
                                "nickname": "MARTINEZLUCAS20211228232048"
                            },
                            "total_amount": 18000,
                            "paid_amount": 18000,
                            "currency_id": "ARS",
                            "status": "paid"
                        }
                    ],
                    "sort": {
                        "id": "date_asc",
                        "name": "Date ascending"
                    },
                    "available_sorts": [
                        {
                            "id": "date_desc",
                            "name": "Date descending"
                        }
                    ],
                    "filters": [],
                    "paging": {
                        "total": 1,
                        "offset": 0,
                        "limit": 51
                    },
                    "display": "complete"
                }

        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Para obtener las opiniones recibidas por un comprador o un vendedor en un pedido:
                Request a:
                    https://api.mercadolibre.com/orders/$PEDIDO_ID/feedback
                    Con Bearer: $ACCESS_TOKEN
                Ejemplo:
                    https://api.mercadolibre.com/orders/1047842538/feedback
                    Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
                Response:
                    {
                        "sale": {
                          "to": {
                            "id": 207040551,
                            "status": "active",
                            "nickname": "TETE5029382",
                            "points": 100
                          },
                          "extended_feedback": [],
                          "has_seller_refunded_money": false,
                          "status": "hidden",
                          "reason": "THEY_DIDNT_ANSWER",
                          "site_id": "MLA",
                          "date_created": "2016-02-29T15:00:50.000-04:00",
                          "from": {
                            "id": 207035636,
                            "status": "active",
                            "nickname": "TETE9544096",
                            "points": 100
                          },
                          "order_id": 2000003508419015,
                          "modified": false,
                          "id": 9040351529869,
                          "message": "Operation not completed",
                          "fulfilled": false,
                          "item": {
                            "id": "MLA607850752",
                            "title": "Item De Testeo, Por Favor No Ofertar --kc:off",
                            "price": 10,
                            "currency_id": "ARS"
                          },
                          "visibility_date": null,
                          "reply": null,
                          "role": "seller",
                          "app_id": "6760432476394748",
                          "rating": "neutral",
                          "restock_item": true
                        },
                        "purchase": null
                    }
        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        || Seguimiento del envio:
                    Hacer request a:
                        https://api.mercadolibre.com/orders/$PEDIDO_ID/shipments
                    Ejemplo:
                        https://api.mercadolibre.com/orders/123456789/shipments
                        Bearer: APP_USR-4214006257775007-033017-36ea96eea5296537704374468c977216-1047842538
                    Response:
                        {
                            "id": 123456789,
                            "mode": "me2",
                            "created_by": "receiver",
                            "order_id": 123456789,
                            "order_cost": 120,
                            "base_cost": 0,
                            "site_id": "MLB",
                            "status": "ready_to_ship",
                            "substatus": "printed",
                            "status_history": {
                                "date_cancelled": null,
                                "date_delivered": null,
                                "date_first_visit": null,
                                "date_handling": "2019-09-02T15:12:36.000-04:00",
                                "date_not_delivered": null,
                                "date_ready_to_ship": "2019-09-02T15:12:36.000-04:00",
                                "date_shipped": null,
                                "date_returned": null
                            },
                            "substatus_history": [],
                            "date_created": "2019-09-02T15:12:31.000-04:00",
                            "last_updated": "2019-09-02T15:16:52.000-04:00",
                            "tracking_number": "1010101231564564",
                            "tracking_method": "Sedex",
                            "service_id": 22,
                            "carrier_info": null,
                            "sender_id": 4312345678,
                            "sender_address": {
                                "id": 103123456789,
                                "address_line": "XXXXXXX",
                                "street_name": "XXXXXXX",
                                "street_number": "XXXXXXX",
                                "comment": "XXXXXXX",
                                "zip_code": "02551234",
                                "city": {
                                    "id": "BR-SP-44",
                                    "name": "São Paulo"
                                },
                                "state": {
                                    "id": "BR-SP",
                                    "name": "São Paulo"
                                },
                                "country": {
                                    "id": "BR",
                                    "name": "Brasil"
                                },
                                "neighborhood": {
                                    "id": null,
                                    "name": "Vila Diva (Zona Norte)"
                                },
                                "municipality": {
                                    "id": null,
                                    "name": null
                                },
                                "agency": null,
                                "types": [
                                    "billing",
                                    "default_selling_address",
                                    "shipping"
                                ],
                                "latitude": 0,
                                "longitude": 0,
                                "geolocation_type": "ROOFTOP"
                            },
                            "receiver_id": 43223123456,
                            "receiver_address": {
                                "id": 1035123456,
                                "address_line": "Avenida Brigadeiro Faria 123456",
                                "street_name": "Avenida Brigadeiro Faria Lima",
                                "street_number": "123456",
                                "comment": null,
                                "zip_code": "07131234",
                                "city": {
                                    "id": "BR-SP-41",
                                    "name": "Guarulhos"
                                },
                                "state": {
                                    "id": "BR-SP",
                                    "name": "São Paulo"
                                },
                                "country": {
                                    "id": "BR",
                                    "name": "Brasil"
                                },
                                "neighborhood": {
                                    "id": null,
                                    "name": "Cocaia"
                                },
                                "municipality": {
                                    "id": null,
                                    "name": null
                                },
                                "agency": null,
                                "types": [
                                    "default_buying_address"
                                ],
                                "latitude": -23.442744,
                                "longitude": -46.522703,
                                "geolocation_type": "ROOFTOP",
                                "delivery_preference": "residential",
                                "receiver_name": "Teste Joaozinho",
                                "receiver_phone": "48 12341234"
                            },
                            "shipping_items": [
                                {
                                    "id": "MLB1223012345",
                                    "description": "Bermuda adidas Teste Titulo Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Teste Te",
                                    "quantity": 1,
                                    "dimensions": "9.0x25.0x32.0,310.0",
                                    "dimensions_source": {
                                        "id": "mp2v_similarity_MLB1223012345",
                                        "origin": "mp2v_similarity"
                                    }
                                }
                            ],
                            "shipping_option": {
                                "id": 19647123456,
                                "shipping_method_id": 182,
                                "name": "Expresso",
                                "currency_id": "BRL",
                                "list_cost": 15.45,
                                "cost": 0,
                                "delivery_type": "estimated",
                                "estimated_schedule_limit": {
                                    "date": null
                                },
                                "estimated_delivery_time": {
                                    "type": "known_frame",
                                    "date": "2019-09-04T00:00:00.000-03:00",
                                    "unit": "hour",
                                    "offset": {
                                        "date": "2019-09-05T00:00:00.000-03:00",
                                        "shipping": 24
                                    },
                                    "time_frame": {
                                        "from": null,
                                        "to": null
                                    },
                                    "pay_before": null,
                                    "shipping": 24,
                                    "handling": 24,
                                    "schedule": null
                                },
                                "estimated_delivery_limit": {
                                    "date": "2019-09-19T00:00:00.000-03:00",
                                    "offset": 240
                                },
                                "estimated_delivery_final": {
                                    "date": "2020-01-03T00:00:00.000-03:00",
                                    "offset": 1920
                                },
                                "estimated_delivery_extended": {
                                    "date": "2019-09-12T00:00:00.000-03:00",
                                    "offset": 120
                                },
                                "estimated_handling_limit": {
                                    "date": "2019-09-03T00:00:00.000-03:00"
                                }
                            },
                            "comments": null,
                            "date_first_printed": "2019-09-02T15:16:51.000-04:00",
                            "market_place": "MELI",
                            "return_details": null,
                            "tags": [
                                "test_shipment"
                            ],
                            "delay": [
                                "handling_delayed"
                            ],
                            "type": "forward",
                            "logistic_type": "drop_off",
                            "application_id": null,
                            "return_tracking_number": null,
                            "cost_components": {
                                "special_discount": 0,
                                "loyal_discount": 0,
                                "compensation": 0,
                                "gap_discount": 0,
                                "ratio": 23.35
                            }
                        }

        ----------------------------------------------------------------------------------------------------
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        ||
        ----------------------------------------------------------------------------------------------------

        ////////////////////////////////////////////////////////////////////////////////////////////////////

    */

    // || ---------------------------------------------------------------------------------------- || //

    public function responder(Request $req)
    {
        $response = $this->call('https://api.mercadolibre.com/answers', [
            '{"question_id":"' .$req->question_id. '","text":"' . $req->text . '"}',
        ], [
            "Content-Type: application/json",
            "Authorization: Bearer " . env("ACCESS_TOKEN")
        ],
            true
        );


        return $response;
    }

    function call($url = '', $params = [], $headers = [], $post = false)
    {
        $lastUrl = $url;
        $curl = curl_init($lastUrl);


        if (count($params) >= 1) {
            if ($post == false) {
                $lastUrl .= '?';
                foreach ($params as $p) {
                    $lastUrl .= $p . '&';
                }
            } else {
                curl_setopt($curl, CURLOPT_POST, 1);
                
                curl_setopt(
                    $curl,
                    CURLOPT_POSTFIELDS,
                    $params[0]
                );
            }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);
        if (isset(json_decode($response)->message)) {
            if (json_decode($response)->message == "Invalid token") {
                $ret = array(
                    '0' => ['results' => 'ACCESS TOKEN ERR']
                );
                return json_decode(json_encode(array_values($ret)))[0];
            }
        }
        return json_decode($response);
    }

    
}
