<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AppointmentStoreRequest extends ExtendedFormRequest
{
    #[ArrayShape(['begin_time' => "string[]", 'end_time' => "string[]", 'note' => "string[]"])] public function rules(): array
    {
        return [
            'begin_time' => ['required', 'date_format:Y-m-d H:i:s', 'before:end_time', 'after:now'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s', 'after:begin_time', 'after:now'],
            'note' => ['string']
        ];
    }
}
