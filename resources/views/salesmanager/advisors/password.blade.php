@extends('layouts.app')
@section('title','Editar contraseña '.$user->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2> Editar contraseña </h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['admin.users.update2',$user->id], 'method' => 'put')) !!}﻿
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        {!! Form::label('password','Contraseña') !!}
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'','required']) !!}
     </div>
     </div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
        {!! Form::label('password2','Repetir Contraseña') !!}
        {!! Form::password('password2',['class'=>'form-control','placeholder'=>'','required']) !!}
     </div>
 </div>
 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <center>
     <div class="form-group">
        {!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
     </div>
     </center>
 </div>
{!! Form::close() !!}
@endsection