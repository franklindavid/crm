<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Negotiation; 
use App\Client;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\SalesManagerAdvisorUpdateRequest;

class MarketingManagerAdvisorController extends Controller
{
    public function index(Request $request){
        $advisors = User::where('type', '=', 'advisor')->where('name', 'LIKE', '%'.$request->name.'%')->Paginate(11);
        return view('marketingmanager.advisors.index')->with('advisors',$advisors)->with('request',$request->name);
    }
    public function edit($id){
        $user = User::find($id);
        return view('marketingmanager.advisors.edit')->with('user',$user);        
    }
    public function update(marketingmanagerAdvisorUpdateRequest $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->password=bcrypt($request->password);
        $user->save();
        flash('se ha modificado el usuario de id '.$user->id.' de forma exitosa!', 'success');
        return redirect()->route('marketingmanager.advisors.index');        
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        flash('se ha eliminado '.$user->name.' de forma exitosa!', 'warning');
        return redirect()->route('marketingmanager.advisors.index');
    
    }
     public function index2($id){
        $clients = Client::where('user_id', '=', $id)->Paginate(11);
        return view('marketingmanager.advisors.index2')->with('clients',$clients); 
    }
    public function negociacion($id){
        $user = User::find($id);
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '!=', 'ganada')->Paginate(11);
        return view('marketingmanager.advisors.negociacion')->with('negotiations',$negotiations)->with('user',$user); 
    } 
    public function venta($id){
        $user = User::find($id);
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '=', 'ganada')->Paginate(11);
        return view('marketingmanager.advisors.venta')->with('negotiations',$negotiations)->with('user',$user); 
    }
}
