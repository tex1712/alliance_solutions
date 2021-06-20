<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
            'data.id' => 'required|string',
            'data.type' => 'required|in:expenses',
            'data.attributes' => 'sometimes|array',
            'data.attributes.name' => 'sometimes|string',
            'data.attributes.total' => 'sometimes|string',
            'data.attributes.date' => 'sometimes|date_format:Y-m-d'
        ];
    }
}
