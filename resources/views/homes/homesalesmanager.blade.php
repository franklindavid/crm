@extends('layouts.app')

@section('content')

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
	<div class="box box-primary">
		<div class="box-header">
		</div>
		<div class="box-body" id="container2">
		</div>
	    <div class="box-footer">
		</div>
	</div>
</div>
          
@endsection 
@section('js')
   <script>
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

    var url = "salesmanager/grafica_venta_anual_home/"+anio+"";


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
       function cargar_grafica_clientes_mes(anio,mes){
    var options={
         chart: {
                renderTo: 'container2',
                type: 'column'
            },
            title: {
                text: 'Numero de Clientes/prospecto en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'dias del mes'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'REGISTROS AL DIA'
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
                name: 'prospecto',
                data: []

            },{
                name: 'cliente', 
                data: []

            }],
           credits: {
               enabled: false
           },
    }

    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "salesmanager/grafica_clientes/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var totaldias=datos.totaldias;
    var registrosclientes=datos.registrosclientes;
    var registrosprospectos=datos.registrosprospectos;
    var i=0;
        for(i=1;i<=totaldias;i++){

        options.series[0].data.push( registrosprospectos[i] );
        options.series[1].data.push( registrosclientes[i] );
        options.xAxis.categories.push(i);
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    
    options.title.text='Numero de Clientes/prospecto en '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
       cargar_grafica_ventas_anuales(<?= $anio; ?>);  
       cargar_grafica_clientes_mes(<?= $anio; ?>,<?= intval($mes); ?>);
</script>
@endsection
