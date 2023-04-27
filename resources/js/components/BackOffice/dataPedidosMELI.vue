<template>
    <div>
        <data-table :data="data" :columns="columns" @on-table-props-changed="reloadTable">
            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" v-model="tableFilters.length">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <!--<add :accion="accion" @closeDialog="close"></add>-->
                    </div>

                    <div class="col-md-4">
                        <input
                            name="name"
                            class="form-control"
                            v-model="tableFilters.search"
                            placeholder="Buscar pregunta"
                        />
                        <!--
                        <div style="float: right; margin: 10px; margin-right: 0">
                            <button type="button" class="btn btn-outline-secondary" @click="previousPage">
                                Anterior
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="nextPage">Siguiente</button>
                        </div>
                    --></div>
                </div>
            </div>
        </data-table>

        <productosPedidoMLVue
            ref="productosPedidoML"
            :data="this.data"
        >            
        </productosPedidoMLVue>
    </div>
</template>

<script>
import productosPedidoMLVue from './productosPedidoML.vue';
import VerProductosPedidoVue from './VerProductosPedido.vue';
export default {
    data() {
        return {
            data: {},
            columns: [
                {
                    label: 'Usuario',
                    name: 'nickname',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Productos',
                    name: '',
                    orderable: true,
                    event: 'click',
                    handler: this.verProductos,
                    component: VerProductosPedidoVue,
                },
                {
                    label: 'Monto',
                    name: 'cpago',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Estado',
                    name: 'ePedido',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                    // || Para indicar el estado del pedido, https://api.mercadolibre.com/orders/search?seller=207035636', tags[]...
                    
                },
                {
                    label: 'Fecha',
                    name: 'fpago',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
            ],
        };
    },
    props: {
        dprop: {},
    },
    mounted() {
        let tempData = JSON.parse(this.dprop);
        /*
            Nombre del comprador, = buyer.nickname
            los productos comprados, order_items{} => [x] => quantity & item.title
            cantidad de pago, order_items{} => [x] => full_unit_price * quantity
            fecha del pago, date_created
            moneda del pago, currency_id
        */
        let fdata = [];
        tempData.map((orden) => {
            var estado = '';
            var cantidadPago = 0;
            orden.order_items.map((item) => {
                cantidadPago += item.unit_price * item.quantity;
            });

            if(orden.tags[0] == 'delivered') {
                estado = 'Enviado';
            }
            else if (orden.tags[0] == 'not_delivered') {
                estado = 'No entregado';
            }
            else {
                estado = orden.tags[0] + ' | ' + orden.tags[1];
            }

            var tmp = {
                nickname: orden.buyer.nickname,
                productos: orden.order_items,
                cpago: cantidadPago + '$ ' + orden.currency_id,
                fpago: orden.date_created,
                ePedido: estado,
            };
            fdata.push(tmp);
        });
        this.data = {
            data: fdata,
        };

    },
    methods: {
        reloadTable(props) {},
        verProductos(data) {
            // || Open Modal
            this.$refs.productosPedidoML.openModal();
        },
    },
    components: {
        productosPedidoMLVue,
        VerProductosPedidoVue,
    },
};
</script>

<style></style>
