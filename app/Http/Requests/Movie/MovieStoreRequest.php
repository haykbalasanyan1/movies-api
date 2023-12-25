<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'publishing_year' => ['required', 'date_format:Y', 'before:now'],
            'poster' => ['required', 'mimes:png,jpg,webp,jpeg'],
        ];
    }
}
