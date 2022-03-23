@extends('layouts.app')
@section('title','Estadisticas Venta')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas ventas </h2>   
    </div>
        <div class="panel-body">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#" onclick="uno()">Ventas</a></li>  
      <li><a href="#" onclick="dos()">Ingresos</a></li>  
    </ul>
  </div>
</nav>
<!--///////////////////////////////-->
<div  class="row" > 
    <div class="col-md-6"> 
<!--        <label>Año</label>-->
        <select class="form-control" id="anio_sel_uno"  onchange="cambiar_fecha_uno();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select> 
        <select class="form-control hidden" id="anio_sel_dos"  onchange="cambiar_fecha_dos();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
    </div>
</div>
<div  class="row">
<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>
		<div class="box-body" id="container">
		</div>
	    <div class="box-footer">
		</div>
	</div>
</div>
@endsection


@section('js')
<script>
    function uno(){
        var anio_sel=$("#anio_sel_uno").val();
        cargar_grafica_ventas_anuales(anio_sel);
        $('#anio_sel_uno').removeClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
}
function dos(){
        var anio_sel=$("#anio_sel_dos").val();
        cargar_grafica_ingresos_anuales(anio_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#anio_sel_dos').removeClass('hidden');
}
    function cambiar_fecha_uno(){
        var anio_sel=$("#anio_sel_uno").val();
        cargar_grafica_ventas_anuales(anio_sel);  
    }
    function cambiar_fecha_dos(){
        var anio_sel=$("#anio_sel_dos").val();
        cargar_grafica_ingresos_anuales(anio_sel);  
    }
function cargar_grafica_ventas_anuales(anio){
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
                    text: 'ventas al mes'
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
                name: 'ventas',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../grafica_venta_anual/"+anio+"";


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalventas=datos.totalventas;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalventas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='Ventas '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    function cargar_grafica_ingresos_anuales(anio){
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
                    text: 'ingresos al mes'
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
                name: 'ingresos',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../grafica_ingreso_anual/"+anio+"";
//        


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalventas=datos.totalventas;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalventas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='Ingresos '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
cargar_grafica_ventas_anuales(<?= $anio; ?>);
</script>
@endsection