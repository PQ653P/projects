<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends ExtendedFormRequest
{
    #[ArrayShape(['email' => "string", 'password' => "string", 'remember_me' => "string"])]
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ];
    }

    public function credentials(): array
    {
        return $this->except('remember_me');
    }
}
