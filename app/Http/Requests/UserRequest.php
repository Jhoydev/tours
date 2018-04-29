<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $res = [
            'first_name'    => 'required|string|max:255',
            'password'      => 'required|string|min:6|confirmed',
            'email'         => 'required|string|email|max:255|unique:users'
        ];
        if ($request->method == "PUT"){
            $res['email']       =  'required|string|email|max:255|unique:users,email,'.$this->user;
        }
        return $res;
    }
}
