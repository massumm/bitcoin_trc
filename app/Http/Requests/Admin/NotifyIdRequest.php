<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class NotifyIdRequest extends FormRequest
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
            'uid' => [
                'required'
            ],

            'player_id' => [

                'required',
                'string',
                'max:255'
            ],

            'token' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }
}
