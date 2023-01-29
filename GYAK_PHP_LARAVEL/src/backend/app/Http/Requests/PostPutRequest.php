<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PostPutRequest extends ExtendedFormRequest
{
    #[ArrayShape(['title' => "string[]", 'content' => "string[]", 'image_change' => "string[]", 'image' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'string','min:3'],
            'content' => ['required', 'string', 'min:10'],
            'image_change' => ['required', 'boolean'],
            'image' => ['file', 'max:15360', 'mimes:jpeg,png,gif,tiff,webp'] //max:15360,because it defines size in kilobytes
        ];
    }
}
