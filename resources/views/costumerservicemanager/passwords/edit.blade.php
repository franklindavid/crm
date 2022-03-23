@extends('layouts.app') 
@section('title','editar contraseña '.$user->name)
@section('content')
<div class="panel panel-default">
    <!-- Content Header (Page header) -->
    <body style="background-color:#E0F2F0">
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2 ><i class="fa fa-lock"></i> Cambiar contraseña </h2>  </div>
    <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['costumerservicemanager.passwords.update',$user->id], 'method' => 'put')) !!}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <div class="form-group">
        {!! Form::label('password','Actual Contraseña') !!}
        {!! Form::password('currentpassword',['class'=>'form-control','placeholder'=>'','required']) !!}
     </div>
     </div>
<br>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        {!! Form::label('password','Nueva Contraseña') !!}
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'','required']) !!}
     </div>
     </div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
        {!! Form::label('password2','Repetir Nueva Contraseña') !!}
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