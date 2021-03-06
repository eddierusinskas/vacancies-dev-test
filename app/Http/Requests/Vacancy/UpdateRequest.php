<?php

namespace App\Http\Requests\Vacancy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'location'    => 'nullable|string',
            'salary_from' => 'nullable|numeric',
            'salary_to'   => 'nullable|numeric'
        ];
    }
}
