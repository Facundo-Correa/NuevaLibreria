<?php

namespace TypiCMS\Modules\Booklists\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'title' => 'string|max:255',
            'booklists_types_id' => 'numeric',
            'status' => 'nullable|boolean',
            'image' => 'nullable',
            'position' => 'nullable|numeric',
            'booklists_sections_id' => 'nullable',
            // || No entiendo bien como la linea inferior detectaba que no existian libros jajaja
            'isbn' => 'nullable|array',
        ];
    }
}
