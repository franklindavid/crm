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
</div>
          
@endsection 
@section('js')
<script>
    function cargar_grafica_tickets_mes(anio){
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
                    text: 'tickets al mes'
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
                name: 'total tickets',
                data: []

            },
                    {
                name: 'resueltos',
                data: []

            },
                    {
                name: 'pendientes',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "costumerservicemanager/grafica_ticket_anual/"+anio+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalperdidas=datos.totalpendientes;
    var totalenproceso=datos.totalresueltos;
    var totalnegociaciones=datos.totaltickets;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalnegociaciones[i] );
        options.series[1].data.push( totalenproceso[i] );
        options.series[2].data.push( totalperdidas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='TICKETS '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    cargar_grafica_tickets_mes(<?= $anio; ?>);
</script>
@endsection
