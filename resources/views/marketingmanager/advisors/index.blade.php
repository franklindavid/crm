@extends('layouts.app')
@section('title','Lista de usuarios')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user" aria-hidden="true"></i> Asesores </h2>   
    </div>
        <div class="panel-body">
        
<a title="generar PDF" href="advisor/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o"></i></a>
{!! Form::open(['route'=>'marketingmanager.advisors.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
     <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar asesor...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
     </div>
{!! Form::close() !!} 
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>
		<th>Correo Electronico</th>
		<th><center>Accion</center></th>
	</thead>
	<tbody>
		@foreach($advisors as $advisor)
            <tr>
            	<td>{{ $advisor->id }}</td>
            	<td>{{ $advisor->name }}</td>
            	<td>{{ $advisor->email }}</td>
            	<td>
                   <center>
                    <a title="ver clientes/prospectos" href="{{ route('marketingmanager.advisors.index2',$advisor->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('marketingmanager.advisors.negociacion',$advisor->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a title="ver ventas" href="{{ route('marketingmanager.advisors.venta',$advisor->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-usd"></i>
                    </a>
                    </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $advisors->render() !!}

@endsection