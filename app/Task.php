<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table="tasks";
    protected $fillable=['tipo','motivo','lugar','fecha','prioridad','client_id','user_id','schedule_id'];
    public function user(){
        return $this->belongsTo('App\User');
    } 
    public function client(){
        return $this->belongsTo('App\Client');
    } 
}
