 @extends('layouts.app')
@section('title','Editar ticket '.$ticket->id)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-tags"></i> Editar ticket </h2>   
    </div>
        <div class="panel-body">
{{-- {!! Form::open(['route'=>'admin.users.update','method'=>'PUT']) !!} --}}
{!! Form::open(array('route' => ['costumerservicemanager.tickets.update',$ticket->id], 'method' => 'put')) !!}﻿
 <div class="form-group">
 	{!! Form::label('caso','Caso') !!}
 	{!! Form::select('caso',['Soporte Tecnico'=>'Soporte tecnico','Garantia'=>'Garantia','Quejas'=>'Quejas','Reclamos'=>'Reclamos','Mantenimiento'=>'Mantenimiento','Devoluciones'=>'Devoluciones','Otros'=>'Otros'],$ticket->caso,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
    {!! Form::label('prioridad','Prioridad') !!}
    {!! Form::select('prioridad',['1'=>'Alta','2'=>'Media','3'=>'Baja'],$ticket->prioridad,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
</div>
<!--
 <div class="form-group">
 	{!! Form::label('nombre','Nombre') !!}
 	{!! Form::text('nombre',$ticket->nombre,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
 </div> 
 <div class="form-group">
 	{!! Form::label('direccion','Direccion') !!}
 	{!! Form::text('direccion',$ticket->direccion,['class'=>'form-control','placeholder'=>'Direccion','required']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('telefono','Telefono') !!}
 	{!! Form::text('telefono',$ticket->telefono,['class'=>'form-control','placeholder'=>'555orriente','required']) !!}
 </div>
--> 
 <div class="form-group">
        {!! Form::label('estado','Estado') !!}
        {!! Form::select('estado',['unassigned'=>'SIN ASIGNAR','pendiente'=>'PENDIENTE','resuelto'=>'RESUELTO','descartado'=>'DESCARTADO'],$ticket->estado,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
 </div> 
 <div class="form-group">
        {!! Form::label('descripcion','DESCRIPCION') !!}
        {!! Form::textarea('descripcion',$ticket->descripcion,['class'=>'form-control','placeholder'=>'descripcion','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('client_id','Cliente') !!}
        {!! Form::select('client_id',$clients,$ticket->client_id,['class'=>'form-control select-client','placeholder' => 'Seleccione un cliente','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('user_id','Tecnico') !!}
        {!! Form::select('user_id',$technicals,$ticket->user_id,['class'=>'form-control select-user','placeholder' => 'Desconocido','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('products','Producto') !!}        
        {!! Form::select('products[]',$products,$my_products,['class'=>'form-control select-product','multiple']) !!}
    </div>
    
 <div class="form-group">
 	{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
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