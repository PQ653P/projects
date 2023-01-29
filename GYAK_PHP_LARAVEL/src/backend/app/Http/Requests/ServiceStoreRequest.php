<?php

namespace App\Http\Requests;

use App\Models\Service;
use App\Rules\ExistingServer;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class ServiceStoreRequest extends ExtendedFormRequest
{
    #[ArrayShape(['name' => "array", 'description' => "string[]", 'image' => "string[]", 'duration' => "string[]", 'extra' => "string[]"])]
    public function rules(): array
    {
        return array_merge([
            'name' => ['required', 'string', 'min:3', Rule::unique((new Service())->getTable(), 'name')],
            'description' => ['required', 'string', 'min:10'],
            'duration' => ['required', 'numeric', 'min:1'],
            'extra' => ['json'],
            'server' => [ new ExistingServer ]
        ], request()->has('image')
            ? ['image' => ['file', 'max:15360', 'mimes:jpeg,png,gif,tiff,webp']]
            : []
        );
    }
}
