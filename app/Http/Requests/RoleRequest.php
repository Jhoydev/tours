<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles'
        ];
        if ($request->method == "PUT") {
            $res['name'] = 'required|string|max:255|unique:roles,name,' . $this->role;
        }
        return $res;
    }

}
