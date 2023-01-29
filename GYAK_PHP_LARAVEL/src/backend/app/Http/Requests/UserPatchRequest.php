<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UserPatchRequest extends ExtendedFormRequest
{
    #[ArrayShape(['name' => "string[]", 'email' => "array", 'current_password' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        $validationRules = [
            'name' => ['min:3'],
            'email' => ['email', Rule::unique('users')->ignore($this->user?->id)], //Since only the logged in user can edit their OWN profile this is fine
            'current_password' => ['required', 'password:api']
        ];

        if($this->has('password') && !empty($this->get('password'))){
            $validationRules['password'] = Password::toArray();
        }
        return $validationRules;
    }
}
