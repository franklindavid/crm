@extends('layouts.app')
@section('title','Lista de usuarios')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Usuarios </h2>   
    </div>
        <div class="panel-body">
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    <a href="{{ route('admin.users.create') }}" class="btn btn-info">Registrar usuario</a><br>
</div>
{!! Form::open(['route'=>'admin.users.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
     <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar usuario...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
     </div>
{!! Form::close() !!}
<a title="generar PDF" href="user/pdf?name={{$request}}" class="btn btn-danger">Generar pdf <i class="fa fa-file-pdf-o"></i></a>
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>
		<th>Correo Electronico</th>
		<th>Tipo</th>
		<th><center>Accion</center></th>
	</thead> 
	<tbody>
		@foreach($users as $user)
            <tr>
            	<td>{{ $user->id }}</td>
            	<td>{{ $user->name }}</td>
            	<td>{{ $user->email }}</td>
            	<td>
                    @if($user->type == "admin")
                        <span class="label label-danger">Administrador</span>
                    @elseif(($user->type == "advisor"))
                        <span class="label label-primary">Asesor</span> 
                    @elseif(($user->type == "technical"))
                        <span class="label label-primary">Tecnico</span>  
                    @elseif(($user->type == "sales_manager"))
                        <span class="label label-primary">Jefe de ventas</span>
                    @elseif(($user->type == "marketing_manager"))
                        <span class="label label-primary">Jefe de marketing</span>
                    @elseif(($user->type == "customer_service_manager"))
                        <span class="label label-primary">Jefe de servicio al cliente</span>
                    @endif
            	</td>
            	<td>
                    @if(($user->type == "advisor") or ($user->type == "sales_manager" ))
                    <a title="ver clientes/prospectos" href="{{ route('admin.users.index2',$user->id) }}" class=" btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('admin.users.negociacion',$user->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a title="ver ventas" href="{{ route('admin.users.venta',$user->id) }}" class="btn btn-default btn-xs">
                        <i class="fa fa-usd"></i>
                    </a>
                    <a title="ver estadisticas" href="{{ route('admin.users.stats',$user->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-bar-chart"></i>
                    </a>
                    <a title="ver tareas" href="{{ route('admin.users.tasks',$user->id) }}" class="btn btn-default btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endif
                    @if(($user->type != "customer_service_manager"))
                     <a title="ver agenda" href="{{ route('admin.users.schedules',$user->id) }}" class="btn btn-info btn-xs">
                         <i class="fa fa-calendar"></i>
                     </a>
                    @endif
                    <a title="modificar contraseña" href="{{ route('admin.users.password',$user->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-lock"></i>
                    </a>
                    <a title="modificar" href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-wrench"></i>
                    </a>
                    @if($user->type != "admin")
                        <a title="eliminar" href="{{ route('admin.users.destroy',$user->id) }}" onclick="return confirm('¿desea eliminar el usuario?')" class=" btn btn-danger btn-xs">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $users->render() !!}

@endsection