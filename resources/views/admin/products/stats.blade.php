@extends('layouts.app')
@section('title','Estadisticas')
@section('content')

<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas </h2>   
    </div>
        <div class="panel-body">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
<!--      <li><a href="#" onclick="clientes()">Productos/Servicios</a></li>-->
    </ul>
  </div>
</nav>
   <?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>
    <div class="col-md-6">
      <center><label class="hidden">Año</label>
      <select class="form-control" id="anio_sel"  onchange="cambiar_fecha();">
        <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
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
    function cambiar_fecha(){
        var anio_sel=$("#anio_sel").val();
        cargar_productos_anuales(anio_sel,{{$id}});
    }
function cargar_productos_anuales(anio,id){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Numero de Clientes/prospecto en el Mes julio'
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
                    text: 'producto/servicio al mes'
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
                name: 'producto/servicio',
                data: []

            }],
           credits: {
               enabled: false
           },
    }
 
//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../../grafica_productos_anuales/"+anio+"/"+id+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalproductos=datos.totalproductos;
    var totalprospectos=datos.totalprospectos;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalproductos[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='ventas {{$name}} '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    var anio_sel=$("#anio_sel").val();
    cargar_productos_anuales(anio_sel,{{$id}});
</script>
@endsection