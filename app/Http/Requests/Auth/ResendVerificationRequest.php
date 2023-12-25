<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResendVerificationRequest extends FormRequest
{
    public function authorize()
    {
        return !$this->user()->hasVerifiedEmail();
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
