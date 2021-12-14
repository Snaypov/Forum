<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'nickname' => 'required|min:3',
            'photo' => 'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return[
            'password.required' => 'Password is required'
        ];
//        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
