<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referred extends Model
{
    protected $table="referreds";
    protected $fillable=['client_id','padre_id'];
     public function client(){
        return $this->belongsTo('App\Client');
    }
}
