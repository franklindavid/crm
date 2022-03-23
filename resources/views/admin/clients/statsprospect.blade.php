@extends('layouts.app')
@section('title','Estadisticas Prospecto')
@section('left')

@endsection
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas <font style="text-transform: capitalize;">{{ $client->estado}} {{ $client->name}} </font></h2>   
    </div>
        <div class="panel-body">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#" onclick="ventas()">Negociaciones/Ventas</a></li>
      <li><a href="#" onclick="referidos()">Referidos</a></li>
    </ul>
  </div>
</nav>
    <div class="col-md-6">
      <center><label class="hidden">Año</label>
      <select class="form-control" id="anio_sel_venta"  onchange="cambiar_fecha_venta();">
        <option value="2017" >2017</option>
        <option value="2018">2018</option>
        <option value="2019" >2019</option>
        <option value="2020" >2020</option>
        <option value="2021" >2021</option>
      </select>
       <select class="form-control hidden" id="anio_sel_referido"  onchange="cambiar_fecha_referido();">
        <option value="2017" >2017</option>
        <option value="2018">2018</option>
        <option value="2019" >2019</option>
        <option value="2020" >2020</option>
        <option value="2021" >2021</option>
      </select>
    </center> 
    </div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 1000px; margin: 0 auto"></div>
@endsection
@section('js')
<script> 
    function cambiar_fecha_venta(){
        var anio_sel=$("#anio_sel_venta").val();
        cargar_ventas_anuales(anio_sel,{{$id}});
    }
    function cambiar_fecha_referido(){
        var anio_sel=$("#anio_sel_referido").val();
        cargar_referidos_anuales(anio_sel,{{$id}});
    }
    function ventas(){
        $('#anio_sel_venta').removeClass('hidden');
        $('#anio_sel_referido').addClass('hidden');
        $('#anio_sel_ticket').addClass('hidden');
        var anio_sel=$("#anio_sel_venta").val();
        cargar_ventas_anuales(anio_sel,{{$id}});
    }
    function referidos(){
        $('#anio_sel_venta').addClass('hidden');
        $('#anio_sel_referido').removeClass('hidden');
        $('#anio_sel_ticket').addClass('hidden');
        var anio_sel=$("#anio_sel_referido").val();
        cargar_referidos_anuales(anio_sel,{{$id}});
    }
    function cargar_ventas_anuales(anio,id){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Numero de negociaciones en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                 categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                    ],
                 title: {
                    text: 'meses'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'negociaciones al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'negociaciones',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../../grafica_ventas_anuales_cliente/"+anio+"/"+id+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalnegociaciones=datos.totalnegociaciones;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalnegociaciones[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='negociaciones {{ $client->name }} '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    function cargar_referidos_anuales(anio,id){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Numero de ventas/negociaciones en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                 categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                    ],
                 title: {
                    text: 'meses'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'referidos al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'referidos',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../../grafica_referidos_anuales_cliente/"+anio+"/"+id+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalventas=datos.totalventas;
//        console.log(totalventas);
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalventas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='Referidos {{ $client->name }} '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    
    
    var anio_sel=$("#anio_sel_venta").val();
    cargar_ventas_anuales(anio_sel,{{$id}});
</script>
@endsection