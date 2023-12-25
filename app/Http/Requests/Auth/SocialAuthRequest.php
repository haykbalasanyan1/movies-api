<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialAuthRequest extends FormRequest
{
    private const SOCIAL_PROVIDERS = [
        'google',
        'facebook',
        'apple',
    ];

    public function rules()
    {
        return [
            'provider' => ['required', 'string', Rule::in(self::SOCIAL_PROVIDERS)],
            'token' => ['required', 'string'],
        ];
    }
}
