<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'data.type' => 'required|in:orders',
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string',
            'data.attributes.total' => 'required|string',
            'data.attributes.client_id' => 'required|string',
            'data.attributes.date' => 'required|date_format:Y-m-d'
        ];
    }
}
