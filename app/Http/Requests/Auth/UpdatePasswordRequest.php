<?php

namespace App\Http\Requests\Auth;

use App\Rules\MatchCurrentPassword;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current' => ['required', 'string', new MatchCurrentPassword()],
            'password' => ['required', 'string', 'different:current', new Password(), 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'password.different' => 'Your current password and new one must be different',
        ];
    }
}
