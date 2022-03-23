@extends('layouts.app')
@section('title','crear product')
@section('content')
{!! Form::open(['route'=>'admin.products.store','method'=>'POST']) !!}
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-wrench"></i> Registrar servicio </h2>   
    </div>
        <div class="panel-body">
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 
 <div class="form-group">
 	{!! Form::label('precio_venta','Precio de venta') !!}
 	{!! Form::text('precio_venta',null,['class'=>'form-control','placeholder'=>'precio de venta','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('descripcion','descripcion') !!}
 	{!! Form::textarea('descripcion',null,['class'=>'form-control textarea-content','placeholder'=>'descripcion'],'required')!!}
 </div>
 
 {!! Form::text('flag',0,['class'=>'form-control hidden','required']) !!}
 {!! Form::text('stock_min',1,['class'=>'form-control hidden','required']) !!}
 {!! Form::text('cantidad',1,['class'=>'form-control hidden','required']) !!}
 {!! Form::text('precio_fabrica',1,['class'=>'form-control hidden','required']) !!}

 
 <div class="form-group">
 	{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection