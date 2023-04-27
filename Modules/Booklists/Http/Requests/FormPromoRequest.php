<?php

namespace TypiCMS\Modules\Booklists\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormPromoRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'title' => 'nullable|max:255',
            'booklists_types_id' => 'numeric',
            'status' => 'nullable|boolean',
            'barcode' => 'nullable|array',
            'position' => 'nullable|numeric',
            'booklists_sections_id' => 'nullable'
        ];
    }
}
