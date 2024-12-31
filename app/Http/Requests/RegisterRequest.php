<?php

namespace App\Http\Requests;


class RegisterRequest extends FormRequest
{

    public function rules()
    {
        $rules = [
            'team'   => 'required|string|max:160',
            'project'   => 'required|max:160',
            'description' => 'required|max:255',
        ];

        for($i = 1; $i <= $this->participant_count; $i++) {
            $rules['participant' . $i . '_name'] = 'required';
            $rules['participant' . $i . '_lastname'] = 'required';
            $rules['participant' . $i . '_email'] = 'required';

        }
        
        return $rules;

    }
}
