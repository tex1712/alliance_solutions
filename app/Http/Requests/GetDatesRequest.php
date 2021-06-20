<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetDatesRequest extends FormRequest
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
            'data' => 'required|array',
            'data.type' => 'required|in:data',
            'data.attributes' => 'required|array',
            'data.attributes.from' => 'required|date_format:Y-m-d',
            'data.attributes.to' => 'required|date_format:Y-m-d'
        ];
    }
}
