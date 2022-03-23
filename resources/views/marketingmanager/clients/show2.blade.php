@extends('layouts.app')
@section('title','editar referido '.$referred->name)
@section('content')
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2> Detalles <font style="text-transform: capitalize;">{{$client->estado}} {{$client->name}}</font> </h2>   
    </div>
        <div class="panel-body">
<div class="form-group">
 	{!! Form::label('estado','Nombre :') !!}
 	{{$client->name}}
</div>
<div class="form-group">
 	{!! Form::label('estado','Cedula :') !!}
 	{{$client->cedula}}
</div>
<div class="form-group">
 	{!! Form::label('estado','Estado :') !!}
 	{{$client->estado}}
</div>  
{!! Form::text('user_id',Auth::user()->id,['class'=>'form-control hidden ','required']) !!} 
<div class="form-group">
 	{!! Form::label('estado','Tipo :') !!}
 	{{$client->tipo}}
</div> 
<div class="form-group">
 	{!! Form::label('estado','Direccion :') !!}
 	{{$client->direccion}}
</div> 
<div class="form-group">
 	{!! Form::label('estado','Telefono :') !!}
 	{{$client->telefono}}
</div>  
<div class="form-group">
 	{!! Form::label('estado','Sexo :') !!}
 	{{$client->sexo}}
</div>   
 
 <div class="form-group">
 	{!! Form::label('whatsapp','Whatsapp :') !!} 	
 	@if($client->whatsapp == 1)
         si
     @else
         no
     @endif
 </div>
 <div class="form-group">
 	{!! Form::label('estado','Email :') !!}
 	{{$client->email}}
</div> 
<div class="form-group">
 	{!! Form::label('estado','Comentarios :') !!}
 	{{$client->comentarios}}
</div>

@endsection