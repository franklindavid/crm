<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    protected $table="negotiations";
    protected $fillable=['estado','detalles','cierre','client_id','product_id','user_id','forma_pago','total_negociacion','created_at'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function client(){
        return $this->belongsTo('App\Client');
    }
    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('cantidad');
    }    
}
//$negotiation=['estado'=>'en proceso','detalles'=>'esperando','cierre'=>'2017-07-20','client_id'=>'1','product_id'=>'1','user_id'=>'2'];