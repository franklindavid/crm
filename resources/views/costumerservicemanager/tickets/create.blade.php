@extends('layouts.app') 
@section('title','Abrir ticket ')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-tags"></i> Abrir ticket </h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(['route'=>'costumerservicemanager.tickets.store','method'=>'POST']) !!}
 <div class="form-group">
 	{!! Form::label('caso','Caso') !!}
<!-- 	{!! Form::text('caso',null,['class'=>'form-control','placeholder'=>'Caso','required']) !!}-->
 	{!! Form::select('caso',['Soporte Tecnico'=>'Soporte tecnico','Garantia'=>'Garantia','Quejas'=>'Quejas','Reclamos'=>'Reclamos','Mantenimiento'=>'Mantenimiento','Devoluciones'=>'Devoluciones','Otros'=>'Otros'],null,['class'=>'form-control','placeholder'=>'seleccione el caso...','required']) !!}
 </div>
 <div class="form-group">
        {!! Form::label('prioridad','Prioridad') !!}
        {!! Form::select('prioridad',['1'=>'Alta','2'=>'Media','3'=>'Baja'],null,['class'=>'form-control','placeholder'=>'seleccione la prioridad...','required']) !!}
    </div>
<!--
 <div class="form-group">
 	{!! Form::label('nombre','Nombre') !!}
 	{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('direccion','Direccion') !!}
 	{!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Direccion','required']) !!}
 </div> 
-->
<!--
 <div class="form-group"> 
        {!! Form::label('estado','Estado') !!}
        {!! Form::select('estado',['pendiente'=>'PENDIENTE','resuelto'=>'RESUELTO','descartado'=>'DESCARTADO'],null,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div> 
-->
 <div class="form-group">
        {!! Form::label('descripcion','DESCRIPCION') !!}
        {!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'descripcion','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('client_id','Cliente') !!}
        {!! Form::select('client_id',$clients,null,['class'=>'form-control select-client','required','placeholder' => 'seleccione un cliente']) !!}
    </div>
<div class="form-group">
        {!! Form::label('user_id','Tecnico') !!}
        {!! Form::select('user_id',$technicals,null,['class'=>'form-control select-user','required','placeholder' => 'seleccione un tecnico']) !!}
    </div>
  <div class="form-group">
        {!! Form::label('products','Producto') !!}        
        {!! Form::select('products[]',$products,null,['class'=>'form-control select-product','multiple']) !!}
    </div>
 <div class="form-group">
 	{!! Form::submit('Abrir ticket',['class'=>'btn btn-primary']) !!} 	
 </div>
{!! Form::close() !!}

@endsection
@section('js')
<script>
    $('.select-client').chosen({
        no_results_text: "no se encuentra el cliente!",
        allow_single_deselect: true
    });
    $('.select-user').chosen({
        no_results_text: "no se encuentra el tecnico!",
        allow_single_deselect: true
    });
    $('.select-product').chosen({
        no_results_text: "no se encuentra el producto/servicio!",
        max_selected_options: 3,
        search_contains: true,
        placeholder_text_multiple: 'seleccione un producto/servicio'
    });
</script>
@endsection