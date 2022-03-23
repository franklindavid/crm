<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User; 
use Hash;
use Auth;

use App\Http\Requests\UserUpdatePasswordRequest;

class PasswordController extends Controller
{
    public function edit($id){
        $user = User::find($id);
//        dd($user->type);
        if ($user->type=='admin'){
            return view('admin.passwords.edit')->with('user',$user); 
        }  
        if ($user->type=='advisor'){
            return view('advisor.passwords.edit')->with('user',$user); 
        }   
        if ($user->type=='sales_manager'){
            return view('salesmanager.passwords.edit')->with('user',$user); 
        }   
        if ($user->type=='marketing_manager'){
            return view('marketingmanager.passwords.edit')->with('user',$user); 
        } 
        if ($user->type=='customer_service_manager'){
            return view('costumerservicemanager.passwords.edit')->with('user',$user); 
        }  
        if ($user->type=='technical'){
            return view('technical.passwords.edit')->with('user',$user); 
        }   
    }
    public function update(UserUpdatePasswordRequest $request, $id){
//        dd($request->currentpassword);
        $actualpasswordcorrecta=Hash::check($request->currentpassword, Auth::user()->password);
//        dd($request->currentpassword);
        
        if ($actualpasswordcorrecta==true){
        $user = User::find($id);
            $user->fill($request->all());
            $user->password=bcrypt($request->password);
            $user->save(); 
            flash('se ha modificado la contraseña del usuario '.$user->name.' de forma exitosa!', 'success');
        }else{
            flash('contraseña actual incorrecta!', 'danger');
        }            
        return back();     
    } 
}
 