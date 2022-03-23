@extends('layouts.app') 
@section('title','editar usuario '.$user->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Editar usuario<font style="text-transform: capitalize;"> {{$user->name}}</font></h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['admin.users.update',$user->id], 'method' => 'put')) !!}﻿
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('email','Correo Electronico') !!}
 	{!! Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'example@gmail.com','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('type','Tipo') !!}
 	{!! Form::select('type',['advisor'=>'asesor','admin'=>'Administrador','technical'=>'Tecnico','sales_manager'=>'Jefe de ventas','marketing_manager'=>'Jefe de marketing','customer_service_manager'=>'Jefe de servicio al cliente'],$user->type,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 
 <div class="form-group">
 	{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
 </div>
{!! Form::close() !!}

@endsection