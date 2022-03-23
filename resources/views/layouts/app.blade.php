<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('favicon.ico')}}"/>
    <title>@yield('title','main') | panel de administracion</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">       
    <!-- Styles -->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datetimepicker/datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
    <link rel="stylesheet" href="{{asset('plugins\trumbowyg\ui\trumbowyg.min.css')}}">

    <style>
        body {
            font-family: 'Lato';
            @if((request()->is('/')) or (request()->is('login')))
            background: url("{{asset('imagenes/ss-target-customer.jpg')}}") no-repeat center center fixed;
/*            background: url("../imagenes/ss-target-customer.jpg") no-repeat center center fixed;*/
            background-size: cover;
            @endif
            
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style> 
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top"  style="background-color:#2E2E2E" >
<!--    <nav class="navbar navbar-inverse navbar-static-top" style="background-color:#585858">-->
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Tellmeyes
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                    @else
                        <li @if(request()->is('home')) class="active" @endif><a href="{{ url('/home') }}"><i class="fa fa-home"></i></a></li>                  
                    @if(Auth::user()->admin())<!-- administrador -->
                        <li @if(request()->is('admin/users')) class="active" @endif><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
<!--                        <li><a href="#">Clientes/Prospectos</a></li> -->
                        <li @if(request()->is('admin/products')) class="active" @endif><a href="{{ route('admin.products.index') }}">Productos/servicios</a></li>
                        <li @if(request()->is('admin/clients')) class="active" @endif><a href="{{ route('admin.clients.index') }}">Clientes/Prospectos</a></li>
                        <li @if(request()->is('admin/negotiations')) class="active" @endif><a href="{{ route('admin.negotiations.index') }}">Negociaciones</a></li> 
                        <li @if(request()->is('admin/sales')) class="active" @endif><a href="{{ route('admin.sales.index') }}">Ventas</a></li> 
                        <li @if(request()->is('admin/tickets')) class="active" @endif><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>   
                        <li @if(request()->is('admin/charts')) class="active" @endif class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Reportes <span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('admin.charts.advisors') }}">Asesores</a></li>
                                <li><a href="{{ route('admin.charts.clients') }}">Prospectos/Clientes</a></li>
                                <li><a href="{{ route('admin.charts.negotiations') }}">Negociaciones</a></li>
                                <li><a href="{{ route('admin.charts.sales') }}">Ventas</a></li>
                                <li><a href="{{ route('admin.charts.products') }}">Productos/servicios</a></li>
                                <li><a href="{{ route('admin.charts.tickets') }}">Tickets</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('admin/events')) class="active" @endif @if(request()->is('admin/schedule')) class="active" @endif  class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Calendario <span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('admin.events.index') }}">Eventos</a></li>
                                <li><a href="{{ route('admin.schedule.index') }}">Agenda</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('admin/emails')) class="active" @endif><a href="{{ route('admin.emails.index') }}"><i class="fa fa-envelope-o"></i></a></li> 
                    @endif
                    @if(Auth::user()->advisor())<!-- asesor -->
                        <li @if(request()->is('advisor/clients')) class="active" @endif><a href="{{ route('advisor.clients.index') }}">Clientes/Prospectos</a></li> 
                        <li @if(request()->is('advisor/negotiations')) class="active" @endif><a href="{{ route('advisor.negotiations.index') }}">Negociaciones</a></li>
                        <li @if(request()->is('advisor/sales')) class="active" @endif><a href="{{ route('advisor.sales.index') }}">Ventas</a></li>
                        <li @if(request()->is('advisor/products')) class="active" @endif><a href="{{ route('advisor.products.showProductAdvisor') }}">Productos/servicios</a></li>
                        <li @if(request()->is('advisor/events')) class="active" @endif @if(request()->is('advisor/schedule')) class="active" @endif class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Calendario<span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('advisor.events.index') }}">Eventos</a></li>
                                <li><a href="{{ route('advisor.schedule.index') }}">Agenda</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('advisor/charts')) class="active" @endif><a href="{{ route('advisor.charts.index') }}">Estadisticas</a></li>
                        <li @if(request()->is('advisor/emails')) class="active" @endif><a href="{{ route('advisor.emails.index') }}"><i class="fa fa-envelope-o"></i></a></li> 
                    @endif 
                    @if(Auth::user()->technical())<!-- tecnico -->
                        <li @if(request()->is('technical/tickets')) class="active" @endif><a href="{{ route('technical.tickets.index') }}">Tickets</a></li>
                        <li @if(request()->is('technical/products')) class="active" @endif><a href="{{ route('technical.products.showProductTechnical') }}">Productos</a></li>
                        <li @if(request()->is('technical/clients')) class="active" @endif><a href="{{ route('technical.clients.index') }}">Clientes/prospectos</a></li> 
                        <li @if(request()->is('technical/schedule')) class="active" @endif><a href="{{ route('technical.schedule.index') }}">Agenda</a></li> 
                    @endif 
                    @if(Auth::user()->sales_manager())<!-- jefe de ventas -->
                        <li @if(request()->is('salesmanager/advisors')) class="active" @endif><a href="{{ route('salesmanager.advisors.index') }}">Asesores</a></li> 
                        <li @if(request()->is('salesmanager/clients')) class="active" @endif @if(request()->is('salesmanager/generalclients')) class="active" @endif class="dropdown" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Clientes/Prospectos<span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('salesmanager.clients.index') }}">Propios</a></li>
                                <li><a href="{{ route('salesmanager.generalclients.index') }}">Generales</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('salesmanager/negotiations')) class="active" @endif><a href="{{ route('salesmanager.negotiations.index') }}">Negociaciones</a></li>
                        <li @if(request()->is('salesmanager/sales')) class="active" @endif><a href="{{ route('salesmanager.sales.index') }}">Ventas</a></li>
                        <li @if(request()->is('salesmanager/products')) class="active" @endif><a href="{{ route('salesmanager.products.showProductSalesManager') }}">Productos</a></li>
                        <li @if(request()->is('salesmanager/events')) class="active" @endif @if(request()->is('salesmanager/schedule')) class="active" @endif class="dropdown"  >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Calendario <span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('salesmanager.events.index') }}">Eventos</a></li>
                                <li><a href="{{ route('salesmanager.schedule.index') }}">Agenda</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('salesmanager/charts')) class="active" @endif><a href="{{ route('salesmanager.charts.index') }}">Estadisticas</a></li>
                        <li @if(request()->is('salesmanager/emails')) class="active" @endif><a href="{{ route('salesmanager.emails.index') }}"><i class="fa fa-envelope-o"></i></a></li>
                    @endif  
                    @if(Auth::user()->marketing_manager())<!-- jefe de marketing -->
                        <li @if(request()->is('marketingmanager/advisors')) class="active" @endif><a href="{{ route('marketingmanager.advisors.index') }}">Asesores</a></li> 
                        <li @if(request()->is('marketingmanager/clients')) class="active" @endif><a href="{{ route('marketingmanager.clients.index') }}">Clientes/Prospectos</a></li>                         
                        <li @if(request()->is('marketingmanager/products')) class="active" @endif><a href="{{ route('marketingmanager.products.showProductMarketingManager') }}">Productos/servicios</a></li>
<!--                        <li><a href="{{ route('marketingmanager.events.index') }}">Eventos <span class="badge">4</span></a></li>-->
                        <li @if(request()->is('marketingmanager/events')) class="active" @endif @if(request()->is('marketingmanager/schedule')) class="active" @endif class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Calendario<span class="caret"></span></a>
                            <ul class="dropdown-menu">                            
                                <li><a href="{{ route('marketingmanager.events.index') }}">Eventos</a></li>
                                <li><a href="{{ route('marketingmanager.schedule.index') }}">Agenda</a></li>
                            </ul>
                        </li>
                        <li @if(request()->is('marketingmanager/charts')) class="active" @endif><a href="{{ route('marketingmanager.charts.index') }}">Estadisticas</a></li>
                        <li @if(request()->is('marketingmanager/emails')) class="active" @endif><a href="{{ route('marketingmanager.emails.index') }}"><i class="fa fa-envelope-o"></i></a></li>
                    @endif  
                    @if(Auth::user()->customer_service_manager())<!-- jefe de servicio al cliente -->
                        <li @if(request()->is('costumerservicemanager/technicals')) class="active" @endif><a href="{{ route('costumerservicemanager.technicals.index') }}">Tecnicos</a></li>
                        <li @if(request()->is('costumerservicemanager/products')) class="active" @endif><a href="{{ route('costumerservicemanager.products.showProductCostumerServiceManager') }}">Productos</a></li>
                        <li @if(request()->is('costumerservicemanager/tickets')) class="active" @endif><a href="{{ route('costumerservicemanager.tickets.index') }}">Tickets</a></li>                        
                        <li @if(request()->is('costumerservicemanager/clients')) class="active" @endif><a href="{{ route('costumerservicemanager.clients.index') }}">Clientes</a></li>  
                        <li @if(request()->is('costumerservicemanager/charts')) class="active" @endif><a href="{{ route('costumerservicemanager.charts.index') }}">Estadisticas</a></li>
                        <li @if(request()->is('costumerservicemanager/emails')) class="active" @endif><a href="{{ route('costumerservicemanager.emails.index') }}"><i class="fa fa-envelope-o"></i></a></li>
                    @endif            
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li @if(request()->is('login')) class="active" @endif><a href="{{ url('/login') }}">Login</a></li>
<!--                        <li @if(request()->is('register')) class="active" @endif><a href="{{ url('/register') }}">Register</a></li>-->
                    @else
                    @if(Auth::user()->advisor())
                        <li class=""><a href="{{ route('advisor.tasks.index') }}"><i class="fa fa-btn fa-bell-o "></i><span class="badge">
<!--
                        {!!$inicio=(date("Y-m-d").' 00:00:00 ')!!}
                        {!! $fin=(date("Y-m-d").' 23:59:00 ') !!}
                        {!! $taskstoday= App\Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->get()!!}
-->
                        {!! count($taskstoday) !!}
                        </span></a></li>
                    @endif
                    @if(Auth::user()->sales_manager())
                        <li class=""><a href="{{ route('salesmanager.tasks.index') }}"><i class="fa fa-btn fa-bell-o "></i><span class="badge">
<!--
                        {!!$inicio=(date("Y-m-d").' 00:00:00 ')!!}
                        {!! $fin=(date("Y-m-d").' 23:59:00 ') !!}
                        {!! $taskstoday= App\Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->get()!!}
-->
                        {!! count($taskstoday) !!}
                        </span></a></li>
                    @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
<!--
                                @if(Auth::user()->advisor())
                                    <li ><a href="{{ route('advisor.charts.index') }}"><i class="fa fa-btn fa-bar-chart "></i>Mis estadisticas</a></li>
                                @endif
-->
                                @if(Auth::user()->admin())
                                    <li><a href="{{ route('admin.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif
                                @if(Auth::user()->advisor())
                                    <li><a href="{{ route('advisor.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif 
                                @if(Auth::user()->technical())
                                    <li><a href="{{ route('technical.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif 
                                @if(Auth::user()->sales_manager())
                                    <li><a href="{{ route('salesmanager.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif  
                                @if(Auth::user()->marketing_manager())
                                    <li><a href="{{ route('marketingmanager.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif  
                                @if(Auth::user()->customer_service_manager())
                                    <li><a href="{{ route('costumerservicemanager.passwords.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-unlock-alt "></i>Cambiar contraseña</a></li>
                                @endif
                                <li ><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out "></i>Salir</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @include('flash::message')
    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error) 
       <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
@endif 
<div class="container">
    <div class="row">
       <div class="col-md-1">
           @yield('left')
       </div>
        <div class="col-md-10 ">
<!--            <div class="panel panel-default">-->
                @yield('content')
<!--            </div>-->
        </div>
        <div class="col-md-1">
           @yield('right')
       </div>
    </div>
</div>
    

    <!-- JavaScripts -->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->
   
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/locale/es.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/datetimepicker/datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('plugins/highcharts/highcharts.js')}}"></script>
    <script src="{{asset('plugins/trumbowyg/trumbowyg.min.js')}}"></script>
    
    
    @yield('js')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
