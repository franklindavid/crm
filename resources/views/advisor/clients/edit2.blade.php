@extends('layouts.app')
@section('title','editar cliente/prospecto '.$referred->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Editar <font style="text-transform: capitalize;">{{$client->estado}} {{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['advisor.referreds.update2',$referred->id], 'method' => 'put')) !!}﻿
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',$referred->name,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
  <div class="form-group">
 	{!! Form::label('cedula','Cedula') !!}
 	{!! Form::text('cedula',$referred->cedula,['class'=>'form-control','placeholder'=>'1065 111 111','required']) !!}
 </div>
 {!! Form::text('user_id',Auth::user()->id,['class'=>'form-control hidden ','required']) !!} 
 <div class="form-group">
 	{!! Form::label('estado','Estado') !!}
 	{!! Form::select('estado',['prospecto'=>'prospecto','cliente'=>'cliente'],$referred->estado,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('tipo','Tipo') !!}
 	{!! Form::select('tipo',['persona'=>'persona','empresa'=>'empresa'],$referred->tipo,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('direccion','Direccion') !!}
 	{!! Form::text('direccion',$referred->direccion,['class'=>'form-control','placeholder'=>'calle falsa 123','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('telefono','Telefono') !!}
 	{!! Form::text('telefono',$referred->telefono,['class'=>'form-control','placeholder'=>'555orriente','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('sexo','Sexo') !!}
 	{!! Form::select('sexo',['femenino'=>'Femenino','masculino'=>'Masculino'],$referred->sexo,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('whatsapp','Whatsapp') !!} 
 	@if($referred->whatsapp==1)	
    {!! Form::label('','') !!}
    {!! Form::label('si','si') !!} 
    {!! Form::radio('whatsapp', 1, true); !!} 
    {!! Form::label('no','no') !!} 
    {!! Form::radio('whatsapp', 0, false); !!} 
 	@else
    {!! Form::label('si','si') !!} 
    {!! Form::radio('whatsapp', 1, false); !!} 
    {!! Form::label('no','no') !!}
    {!! Form::radio('whatsapp', 0, true); !!} 
 	@endif    
 </div>
 <div class="form-group">
 	{!! Form::label('email','Correo Electronico') !!}
 	{!! Form::text('email',$referred->email,['class'=>'form-control','placeholder'=>'example@gmail.com','required']) !!}
 </div>
 @if($client->estado == "prospecto")
     <div class="form-group">
        {!! Form::label('oportunidad','Oportunidad') !!}
        {!! Form::select('oportunidad',['1'=>'Alta','2'=>'Media','3'=>'Baja'],$client->oportunidad,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
    </div>
@endif
 <div class="form-group">
 	{!! Form::label('comentarios','Comentario') !!}
 	{!! Form::textarea('comentarios',$referred->comentarios,['class'=>'form-control textarea-content','placeholder'=>'comentario'],'required')!!}
 </div>  
 <div class="form-group">
 	{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection