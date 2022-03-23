<?php 

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route; 

class AdminUserUpdateRequest extends Request
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
        return [
            'name'=>'regex:[^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$]',
//            'password' => 'required|same:password2',
            'email'=>'email|max:50|unique:users,email,'.$this->route->getparameter('users'),
        ];        
    }
    public function messages(){
        return [
//            'same'=>'las contraseñas deben coincidir',
            'email'=>'el email ingesado no es valido',
            'email.unique'=>'el email ya esta en uso!',
            'name.regex'=>'el campo Nombre solo debe contener letras',
            ]; 
    }
}
