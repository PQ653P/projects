<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class TenantPatchRequest extends FormRequest
{
    #[ArrayShape(['name' => "array", 'description' => "string[]", 'extra' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['string', 'min:3', Rule::unique((new Tenant())->getTable(), 'name')->ignore($this->tenant->id)],
            'description' => ['text', 'min:5'],
            'extra' => ['json']
        ];
    }
}
