<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\User;
use Auth;
use Mail;

class CostumerServiceMailcontroller extends Controller
{
    public function index(){
        $clients = Client::all()->lists('name','id');
        $users = User::all()->lists('name','id');
        return view ('costumerservicemanager.emails.index')->with('clients',$clients)->with('users',$users);
    }
    public function store(Request $request){
        $users = $request->get('users');
        $clients = $request->get('clients');
        $asunto = $request->get('asunto');
        $contenido = $request->get('contenido');
        if ($users){
            foreach ($users as $user){
                $datos = User::find($user);
                Mail::send('costumerservicemanager.emails.correo',['contenido'=> $contenido],function($message) use ($datos,$asunto){
                    $message->from('serviciocliente@tellmeyes.com',Auth::user()->name);
                    $message->to($datos->email,$datos->name)->subject($asunto);
                });
            }
        }
        if ($clients){
            foreach ($clients as $client){
                $datos = Client::find($client);
                Mail::send('costumerservicemanager.emails.correo',['contenido'=> $contenido],function($message) use ($datos,$asunto){
                    $message->from('serviciocliente@tellmeyes.com',Auth::user()->name);
                    $message->to($datos->email,$datos->name)->subject($asunto);
                });
            }
        }
        flash('se ha enviado el correo de forma exitosa!', 'success');
        return redirect()->route('costumerservicemanager.emails.index');
    }
} 
