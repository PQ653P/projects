<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PostPatchRequest extends ExtendedFormRequest
{
    #[ArrayShape(['title' => "string[]", 'content' => "string[]", 'image_changed' => "string[]", 'image' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['string','min:3'],
            'content' => ['string', 'min:10'],
            'image_changed' => ['required', 'boolean'],
            'image' => ['file', 'max:15360', 'mimes:jpeg,png,gif,tiff,webp'] //max:15360,because it defines size in kilobytes
        ];
    }
}
