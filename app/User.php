<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type',
    ];//datos que pueden ser accesados

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function clients(){
        return $this->hasMany('App\Client');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
    public function negotiations(){
        return $this->hasMany('App\Negotiation');
    }
//    public function events(){
//        return $this->belongsToMany('App\Event')->withTimestamps();
//    }
    public function schedule(){
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }
    public function Tickets(){
        return $this->hasMany('App\Ticket');
    }
    public function admin(){
        return $this->type==='admin';
    }
    public function advisor(){
        return $this->type==='advisor';
    }
    public function technical(){
        return $this->type==='technical';
    }
    public function sales_manager(){
        return $this->type==='sales_manager';
    }
    public function marketing_manager(){
        return $this->type==='marketing_manager';
    }
    public function customer_service_manager(){
        return $this->type==='customer_service_manager';
    }
}
 