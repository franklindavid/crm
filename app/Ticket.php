<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table="tickets";
    protected $fillable=['caso','nombre','telefono','direccion','estado','descripcion','client_id','product_id','user_id','prioridad'];
    public function client(){
        return $this->belongsTo('App\Client');
    }
    public function products(){
        return $this->belongsToMany('App\Product')->withTimestamps();
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
//$ticket=['caso'=>'mantenimiento','descripcion'=>'sin descripcion','client_id'=>'1','product_id'=>'1','technical_id'=>'1'];
