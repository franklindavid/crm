@extends('layouts.app') 
@section('title','Lista de usuarios')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Asesores </h2>   
    </div>
        <div class="panel-body">
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
<!--    <a href="{{ route('salesmanager.advisors.create') }}" class="btn btn-info">Registrar asesor</a>-->
    <a title="generar PDF" href="advisor/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o "></i></a>
</div> 
{!! Form::open(['route'=>'salesmanager.advisors.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
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
                    <a title="ver clientes/prospectos" href="{{ route('salesmanager.advisors.index2',$advisor->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('salesmanager.advisors.negociacion',$advisor->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a title="ver ventas" href="{{ route('salesmanager.advisors.venta',$advisor->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-usd"></i>
                    </a>
                    <a title="ver tareas" href="{{ route('salesmanager.advisors.tasks',$advisor->id) }}" class="btn btn-danger btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a title="ver agenda" href="{{ route('salesmanager.advisors.schedules',$advisor->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-calendar"></i>
                    </a>
                    <a title="ver estadisticas" href="{{ route('salesmanager.advisors.stats',$advisor->id) }}" class="btn btn-default btn-xs">
                        <i class="fa fa-bar-chart"></i>
                    </a>
<!--
                    <a title="modificar" href="{{ route('salesmanager.advisors.edit',$advisor->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-wrench"></i>
                    </a>
-->
                    </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $advisors->render() !!}

@endsection 