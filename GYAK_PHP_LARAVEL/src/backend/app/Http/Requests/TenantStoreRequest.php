<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class TenantStoreRequest extends FormRequest
{
    #[ArrayShape(['name' => "array", 'description' => "string[]", 'extra' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique((new Tenant())->getTable(), 'name')],
            'description' => ['required', 'text', 'min:5'],
            'extra' => ['json']
        ];
    }
}
