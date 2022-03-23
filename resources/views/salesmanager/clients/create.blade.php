@extends('layouts.app')
@section('title','crear cliente/prospecto')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Registrar cliente </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'salesmanager.clients.store','method'=>'POST']) !!}
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
  <div class="form-group">
 	{!! Form::label('cedula','Cedula') !!}
 	{!! Form::text('cedula',null,['class'=>'form-control','placeholder'=>'1065 111 111','required']) !!}
 </div>
 {!! Form::text('user_id',Auth::user()->id,['class'=>'form-control hidden ','required']) !!} 
 {!! Form::text('estado','prospecto',['class'=>'form-control hidden ','required']) !!}  
  <div class="form-group">
 	{!! Form::label('tipo','Tipo') !!}
 	{!! Form::select('tipo',['persona'=>'persona','empresa'=>'empresa'],null,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('direccion','Direccion') !!}
 	{!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'calle falsa 123','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('telefono','Telefono') !!}
 	{!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'555orriente','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('sexo','Sexo') !!}
 	{!! Form::select('sexo',['femenino'=>'Femenino','Masculino'=>'Masculino'],null,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('whatsapp','Whatsapp') !!}  	
    {!! Form::label('si','si') !!} 
    {!! Form::radio('whatsapp', 1, false); !!} 
    {!! Form::label('no','no') !!} 
    {!! Form::radio('whatsapp', 0, true); !!}  	
 </div> 
 <div class="form-group">
 	{!! Form::label('email','Correo Electronico') !!}
 	{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'example@gmail.com','required']) !!}
 </div>
 <div class="form-group">
    {!! Form::label('oportunidad','Oportunidad') !!}
 	{!! Form::select('oportunidad',['1'=>'Alta','2'=>'Media','3'=>'Baja'],null,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
</div>
 <div class="form-group">
 	{!! Form::label('comentarios','Comentario') !!}
 	{!! Form::textarea('comentarios',null,['class'=>'form-control textarea-content','placeholder'=>'comentario'],'required')!!}
 </div>   
 <div class="form-group">
 	{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection