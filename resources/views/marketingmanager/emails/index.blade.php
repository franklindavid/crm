@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-envelope-o"></i> Enviar correo </h2>   
    </div>
        <div class="panel-body"> 
        
{!! Form::open(['route'=>'marketingmanager.emails.store','method'=>'POST']) !!}
<div class="form-group">
 	{!! Form::label('name','Clientes destinatarios') !!}
 	{!! Form::select('clients[]',$clients,null,['class'=>'form-control select-destination','multiple']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('name','Usuarios destinatarios') !!}
 	{!! Form::select('users[]',$users,null,['class'=>'form-control select-destination','multiple']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('name','Asunto') !!}
 	{!! Form::text('asunto',null,['class'=>'form-control','placeholder'=>'Asunto','required']) !!}
 </div>
 <div class="form-group">
 {!! Form::label('name','Contenido') !!}
 	{!! Form::textarea('contenido',null,['class'=>'form-control textarea-content','placeholder'=>''],'required')!!}
 </div>   
 <div class="form-group">
 	{!! Form::submit('Enviar',['class'=>'btn btn-primary']) !!} 	
 </div>
{!! Form::close() !!}
        
@endsection
@section('js')
<script>
$('.select-destination').chosen({
        no_results_text: "no se encuentra el destinatiario!",
        search_contains: true,
        placeholder_text_multiple: 'Destinatarios'
    });
    $('.textarea-content').trumbowyg();
</script>
@endsection