<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $fillable=['name','stock_min','cantidad','precio_fabrica','precio_venta','descripcion','flag'];
    public function tickets(){
        return $this->belongsToMany('App\Ticket')->withTimestamps();
    }
    public function negotiations(){
        return $this->belongsToMany('App\Negotiation')->withTimestamps();
    }
}
//$product=['name'=>'filtro 2','stock_min'=>'1','cantidad'=>'10','precio_fabrica'=>'1000','precio_venta'=>'1500','descripcion'=>'filtra agua 2'];
