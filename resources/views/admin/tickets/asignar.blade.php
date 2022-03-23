@extends('layouts.app')
@section('title','asignar ticket')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h1> Asignar ticket </h1> 
    </div>
        <div class="panel-body">
{!! Form::open(array('route' => ['admin.tickets.update2',$ticket->id],'id'=>'formulario', 'method' => 'put')) !!}
<center>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('client_id','Cliente') !!}
        {!! Form::select('client_id',$clients,null,['class'=>'form-control select-client','placeholder' => 'Desconocido']) !!}
    </div>    
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('user_id','Tecnico') !!}
        {!! Form::select('user_id',$technicals,null,['class'=>'form-control select-user','placeholder' => 'Desconocido']) !!}
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
</script>
@endsection