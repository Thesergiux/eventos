<?php

namespace App\Http\Requests;

use App\Rules\NotLowercase;
use App\Rules\NotUppercase;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new NotUppercase, new NotLowercase, 'max:100'],
            'address' => ['required', new NotUppercase, new NotLowercase, 'max:100'],
            'description' => ['required', new NotUppercase, new NotLowercase, 'max:255'],
            'latitude' => ['required', 'max:60'],
            'longitude' => ['required', 'max:60'],
        ];
    }
}
