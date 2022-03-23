<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNegociacion extends Model
{
    protected $table='negotiation_product';
    protected $primaryKey="id";
    protected $fillable=[
        'negotiation_id',
        'product_id',
        'cantidad',
    ];
    protected $guarded =[
        
    ];
}
