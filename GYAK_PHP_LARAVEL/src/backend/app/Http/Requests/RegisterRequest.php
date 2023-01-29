<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends ExtendedFormRequest
{
    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ];
    }
}
