<?php

namespace TypiCMS\Modules\Files\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        $rules = [
            'folder_id' => 'nullable|integer',
            'alt_attribute.*' => 'nullable|max:255',
            'type' => 'nullable|string|max:1',
            'description.*' => 'nullable|max:255',
            'name' => 'nullable|max:255',
        ];

        if ($this->hasFile('name')) {
            $rules['name'] = 'mimes:jpeg,gif,png,bmp,tiff,pdf,eps,svg,rtf,txt,md,doc,xls,ppt,docx,xlsx,ppsx,pptx,sldx,mp4,m4a,aac,aiff,mov,avi,mp3,wav,zip|max:'.config('typicms.max_file_upload_size', 2000);
        }

        return $rules;
    }
}
