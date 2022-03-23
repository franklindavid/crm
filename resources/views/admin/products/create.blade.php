@extends('layouts.app')
@section('title','crear product')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-archive"></i> Registrar producto </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'admin.products.store','method'=>'POST']) !!}
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('stock_min','stock minimo') !!}
 	{!! Form::text('stock_min',null,['class'=>'form-control','placeholder'=>'stock min','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('cantidad','Cantidad') !!}
 	{!! Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'cantidad','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('precio_fabrica','Precio de fabrica') !!}
 	{!! Form::text('precio_fabrica',null,['class'=>'form-control','placeholder'=>'precio de fabrica','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('precio_venta','Precio de venta') !!}
 	{!! Form::text('precio_venta',null,['class'=>'form-control','placeholder'=>'precio de venta','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('descripcion','descripcion') !!}
 	{!! Form::textarea('descripcion',null,['class'=>'form-control textarea-content','placeholder'=>'descripcion'],'required')!!}
 </div>  	
{!! Form::text('flag',1,['class'=>'form-control hidden','required']) !!} 
 <div class="form-group">
 	{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection