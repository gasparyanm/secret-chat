<?php

namespace App\Http\Requests;

use App\Enums\MessageExpiryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SendMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recipient' => ['required', 'email'],
            'message' => ['required', 'string'],
            'expiry_option' => ['required', new Enum(MessageExpiryEnum::class)],
        ];
    }
}
