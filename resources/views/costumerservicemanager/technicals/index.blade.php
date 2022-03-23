@extends('layouts.app')
@section('title','Lista de Técnicos')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Técnicos </h2>   
    </div>
        <div class="panel-body">
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>
		<th>Correo Electronico</th>
		<th><center>Accion</center></th>
	</thead>
	<tbody>
		@foreach($technicals as $technical)
            <tr>
            	<td>{{ $technical->id }}</td>
            	<td>{{ $technical->name }}</td>
            	<td>{{ $technical->email }}</td>
            	<td>
                   <center>
                    <a title="ver tickets" href="{{ route('costumerservicemanager.technicals.ticket',$technical->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-tags"></i>
                    </a>
                    
                    
                    </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $technicals->render() !!}

@endsection 