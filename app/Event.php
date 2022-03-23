<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table="events";
    protected $fillable=['fechainicio','fechafin','todoeldia','color','asunto','informacion','lugar'];
//    public function users(){
//        return $this->belongsToMany('App\User')->withTimestamps();
//    }
} 

//$event=['asunto'=>'juan','informacion'=>'1','hora'=>'08:08:24','fecha'=>'2017-07-20'];

