<?php

namespace App\Http\Requests;

use App\Rules\NotLowercase;
use App\Rules\NotUppercase;
use Illuminate\Validation\Rule;

class ActivityRequest extends FormRequest
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
            'location_id' => ['required'],
            'description' => ['required', new NotUppercase, new NotLowercase, 'max:4000'],
            'type' => ['required', 'max:60'],
            'cover' => 'required_at_create|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
