@extends('layouts.app')
@section('title','Registrar usuario')
@section('content')
 
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Registrar usuario </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'salesmanager.advisors.store','method'=>'POST']) !!}
 <div class="form-group">
 	{!! Form::label('name','Nombre') !!}
 	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('email','Correo Electronico') !!}
 	{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'example@gmail.com','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('password','Contraseña') !!}
 	{!! Form::password('password',['class'=>'form-control','placeholder'=>'','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('password2','Repetir Contraseña') !!}
 	{!! Form::password('password2',['class'=>'form-control','placeholder'=>'','required']) !!}
 </div>
  {!! Form::text('Type','advisor',['class'=>'form-control hidden ','required']) !!} 
 <div class="form-group">
 	{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!} 	
 </div>

{!! Form::close() !!}

@endsection 