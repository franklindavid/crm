<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table="schedule";
    protected $fillable=['fechainicio','fechafin','todoeldia','color','asunto','informacion','lugar','user_id'];
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
