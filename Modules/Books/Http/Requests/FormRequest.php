<?php

namespace TypiCMS\Modules\Books\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required',
            'descriptions_indice' => 'nullable|max:5000',
            'descriptions_description' => 'nullable|max:5000',
            'tags' => 'nullable',
            
        ];
    }
}
