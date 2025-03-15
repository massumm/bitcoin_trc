<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class C_Code_FormRequest extends FormRequest
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
            'c_code' => [
                'required',
                'string',
                'max:200'
            ],
            'status' => [

                'string',
                'max:200'
            ],
        ];
    }
}
