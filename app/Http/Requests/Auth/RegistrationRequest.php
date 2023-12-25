<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'string', new Password(), 'confirmed'],
        ];
    }
}
