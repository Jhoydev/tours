<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRequest extends FormRequest
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
        if ($request->method == "POST") {
            $res = [
                'first_name' => 'required|string|max:255',
                'password'   => 'required|string|min:6|confirmed',
                'email'      => 'required|string|email|max:255|unique:customers',
                'document'   => 'required|string|max:255|unique:customers'
            ];
        } else if ($request->method == "PUT") {
            $res = [
                'first_name' => 'required|string|max:255',
                'password'   => 'string|min:6|confirmed',
            ];
            if (!Auth::guard('customer')->check()){
                $res['email']    = 'required|string|email|max:255|unique:customers,email,' . $this->customer;
            }
            $res['document'] = 'required|string|max:255|unique:customers,document,' . $this->customer;
        }
        return $res;
    }

}
