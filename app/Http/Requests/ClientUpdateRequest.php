<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class ClientUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function __construct(Route $route){
        $this->route=$route;        
    }
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
//        .$this->route->getparameter('product'),
        return [
            'cedula' => 'numeric|unique:clients,cedula,'.$this->route->getparameter('clients'),
            'email' => 'email|unique:clients,email,'.$this->route->getparameter('clients'),
            'name'=>'max:120|required|regex:[^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$]',
            'estado'=>'not_in:0|required',
            'tipo'=>'not_in:0|required',
            'direccion'=>'max:30',
            'telefono'=>'min:7|numeric',
            'sexo'=>'not_in:0|required',            
            'comentarios'=>'max:120', 
        ];
    }
    public function messages(){
        return [            
            'name.regex'=>'el campo Nombre solo debe contener letras',
            ]; 
    }

}
