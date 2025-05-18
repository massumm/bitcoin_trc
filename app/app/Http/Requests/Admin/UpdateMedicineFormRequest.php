<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineFormRequest extends FormRequest
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
        $rules = [

            'title' => [
                'required',
                'string',
                'max:200'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
            ],
            'price' => [
                'required',
                'string',
                'max:200'
            ],
            'type' => [
                'required',
                'string',
                'max:200'
            ],
            'discount' => [
                'required',
                'string'
            ],
            'stock_status' => [
                'required'
            ],
            'description' => [
                'required'
            ],

        ];

        return $rules;
    }
}
