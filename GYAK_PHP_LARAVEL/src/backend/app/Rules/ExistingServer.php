<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ExistingServer implements Rule
{
    public function passes($attribute, $value): bool
    {
        return User::Servers()->where('id', $value)->count() > 0;
    }

    public function message(): string
    {
        return 'This is not a valid server id';
    }
}
