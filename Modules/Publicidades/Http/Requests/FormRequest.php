<?php

namespace TypiCMS\Modules\Publicidades\Http\Requests;

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
            'texto_1' => 'nullable',
            'texto_2' => 'nullable',
            'tipo' => 'nullable',
            'color_1' => 'nullable',
            'color_2' => 'nullable',
            'link' => 'nullable',
            'pagina' => 'nullable',
            'posicion' => 'nullable',
        ];
    }
}
