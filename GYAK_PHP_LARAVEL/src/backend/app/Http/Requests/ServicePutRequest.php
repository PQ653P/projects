<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class ServicePutRequest extends ExtendedFormRequest
{
    #[ArrayShape(['name' => "array", 'description' => "string[]", 'image' => "string[]", 'duration' => "string[]", 'extra' => "string[]"])] public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique((new Service())->getTable(), 'name')],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['file', 'max:15360', 'mimes:jpeg,png,gif,tiff,webp'],
            'duration' => ['required', 'numeric', 'min:1'],
            'extra' => ['json']
        ];
    }
}
