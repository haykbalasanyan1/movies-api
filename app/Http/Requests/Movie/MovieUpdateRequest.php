<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'publishing_year' => ['sometimes', 'date_format:Y', 'before:now'],
            'poster' => ['sometimes', 'mimes:png,jpg,webp,jpeg'],
        ];
    }
}
