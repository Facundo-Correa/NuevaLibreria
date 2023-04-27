<?php

namespace TypiCMS\Modules\Configuraciones\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'slug.*' => 'nullable|alpha_dash|max:255|required_if:status.*,1|required_with:title.*',
            'status.*' => 'boolean',
            'summary.*' => 'nullable',
            'body.*' => 'nullable',
            'fondo_publicidades_home' => 'nullable',
            'fondo_citas_home' => 'nullable',
            'telefonos' => 'nullable',
            'medios_pago' => 'nullable',
            'direcciones' => 'nullable',
            'frase_promociones_1' => 'nullable',
            'frase_promociones_2' => 'nullable',
            'correos_electronicos' => 'nullable',
            'banner_tienda' => 'nullable',

            /*
                $table->string('redes')->nullable();
            $table->string('telefonos')->nullable();
            $table->string('medios_pago')->nullable();
            $table->string('direcciones')->nullable();
            $table->string('frase_promociones_1')->nullable();
            $table->string('frase_promociones_2')->nullable();
            $table->string('correos_electronicos')->nullable();
            */
        ];
    }
}
