<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'name'=>'max:120|required|unique:products',
            'stock_min'=>'min:1|required|numeric',
            'cantidad'=>'min:1|required|numeric',
            'precio_fabrica'=>'min:1|required|numeric',
            'precio_venta'=>'min:1|required|numeric',
            'descripcion'=>'max:120',
        ]; 
    }
    
    public function messages(){
        return [
            'stock_min.not_in'=>'el stock minimo debe ser diferente de 0',
            ]; 
    }
}
