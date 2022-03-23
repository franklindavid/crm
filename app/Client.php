<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Client extends Model
{
    protected $table="clients";
    protected $fillable=['name','user_id','estado','tipo','direccion','telefono','sexo','cedula','whatsapp','email','comentarios','oportunidad'];
    public function negotiations(){
        return $this->hasMany('App\Negotiation');
    }
    public function tickets(){
        return $this->hasMany('App\Ticket');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function referreds(){
        return $this->hasMany('App\Referred');
    }
     public function scopeSearch($query,$name){
        return $query->where('cedula','LIKE',"%$name%")->where('user_id', '=', Auth::user()->id);
    }
} 
//$client=['name'=>'juan','user_id'=>'1','estado'=>'prospecto','tipo'=>'persona','direccion'=>'calle falsa 123','telefono'=>'555555','sexo'=>'femenino','cedula'=>'106545743','whatsapp'=>'true','email'=>'xd@xd.com','comentarios'=>'xd'];
