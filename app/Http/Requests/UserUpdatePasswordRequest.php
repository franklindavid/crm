<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Hash;
use Auth;

class UserUpdatePasswordRequest extends Request
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
            'password' => 'required|same:password2',
//            Hash::check('currentpassword', Auth::user()->password) => 'required|same:true',
//            'currentpassword' => 'required|same:Auth::user()->password',
        ];
    }
    public function messages(){
        return [
            'same'=>'las contraseñas deben coincidir',            
            ]; 
    }
}
