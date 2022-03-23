@extends('layouts.app')
@section('title','Asignar ticket')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2> Asignar ticket </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(array('route' => ['costumerservicemanager.tickets.update2',$ticket->id],'id'=>'formulario', 'method' => 'put')) !!}
<center>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('client_id','Cliente') !!}
        {!! Form::select('client_id',$clients,null,['class'=>'form-control select-client','placeholder' => 'seleccione un cliente','required']) !!}
    </div>    
</div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('user_id','Tecnico') !!}
        {!! Form::select('user_id',$technicals,null,['class'=>'form-control select-user','placeholder' => 'seleccione un tecnico','required']) !!}
    </div>
</div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('products','Producto') !!}        
        {!! Form::select('products[]',$products,null,['class'=>'form-control select-product','multiple']) !!}
    </div>
</div>
</center>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
    <div class="form-group">
       <center>
        {!! Form::submit('Asignar',['class'=>'btn btn-primary']) !!} 
        </center>    
    </div>
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