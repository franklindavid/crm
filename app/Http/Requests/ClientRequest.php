<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class ClientRequest extends Request
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
            'name'=>'max:120|required|regex:[^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$]',
            'estado'=>'not_in:0|required',
            'tipo'=>'not_in:0|required',
            'direccion'=>'max:40',
            'telefono'=>'min:7|numeric',
            'sexo'=>'not_in:0|required',
            'cedula'=>'numeric|unique:clients',
            'email'=>'email|max:50|unique:clients',
            'comentarios'=>'max:120',            
        ];
    }
    public function messages(){
        return [            
            'name.regex'=>'el campo Nombre solo debe contener letras',
            ]; 
    }
}
