<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\Password;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UserStoreRequest extends ExtendedFormRequest
{
    #[ArrayShape(['name' => "string[]", 'email' => "array", 'password' => "array", 'image_change' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User())->getTable(), 'email')],
            'password' => ['required', 'confirmed', 'string', 'min:10', new Password],
        ];
    }
}
