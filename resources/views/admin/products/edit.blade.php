@extends('layouts.app')
@section('title','editar producto '.$product->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-archive"></i> Editar producto <font style="text-transform: capitalize;"> {{$product->name}}</font></h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['admin.products.update',$product->id], 'method' => 'put')) !!}﻿
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',$product->name,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('stock_min','stock minimo') !!}
 	{!! Form::text('stock_min',$product->stock_min,['class'=>'form-control','placeholder'=>'stock min','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('cantidad','Cantidad') !!}
 	{!! Form::text('cantidad',$product->cantidad,['class'=>'form-control','placeholder'=>'cantidad','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('precio_fabrica','Precio de fabrica') !!}
 	{!! Form::text('precio_fabrica',$product->precio_fabrica,['class'=>'form-control','placeholder'=>'precio de fabrica','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('precio_venta','Precio de venta') !!}
 	{!! Form::text('precio_venta',$product->precio_venta,['class'=>'form-control','placeholder'=>'precio de venta','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('descripcion','descripcion') !!}
 	{!! Form::textarea('descripcion',$product->descripcion,['class'=>'form-control textarea-content','placeholder'=>'descripcion'],'required')!!}
 </div>
 {!! Form::text('flag',1,['class'=>'form-control hidden','required']) !!}
 <div class="form-group">
 	{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection