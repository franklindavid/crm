<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {  
    return view('welcome');
});
Route::auth(); 
Route::get('/home', 'HomeController@index');
////////////////////////////////ADMIN/////////////////////////////////
Route::group(['prefix'=>'admin','middleware'=>['auth','AdminMiddleware']],function(){
//-------------------------USERS------------------------------------
    Route::resource('users','UsersController'); 
    Route::get('users/{id}/destroy',[
        'uses' => 'UsersController@destroy',  
        'as' => 'admin.users.destroy'
   	]);
    Route::get('users/index2/{id}',[
        'uses' => 'UsersController@index2',
        'as' => 'admin.users.index2'
   	]);
    Route::get('users/negociacion/{id}',[
        'uses' => 'UsersController@negociacion',
        'as' => 'admin.users.negociacion'
   	]);
    Route::get('users/venta/{id}',[
        'uses' => 'UsersController@venta',
        'as' => 'admin.users.venta'
   	]); 
    Route::get('users/stats/{id}',[
        'uses' => 'UsersController@stats',
        'as' => 'admin.users.stats'
   	]);
    Route::get('users/password/{id}',[
        'uses' => 'UsersController@password',
        'as' => 'admin.users.password'
   	]);
    Route::put('userspassword/{users}',[
        'uses' => 'UsersController@update2',
        'as' => 'admin.users.update2'
   	]);
    Route::get('user/pdf',[
        'uses' => 'PdfController@users',
        'as' => 'admin.users.pdf'
   	]);
    Route::get('users/{id}/tasks',[
        'uses' => 'UsersController@tasks',
        'as' => 'admin.users.tasks'
   	]);
   Route::get('users/createtasks/{id}',[
        'uses' => 'UsersController@createtasks',
        'as' => 'admin.users.createtasks'
   	]);
    Route::get('users/{id}/schedules',[
        'uses' => 'UsersController@schedules',
        'as' => 'admin.users.schedules'
   	]);
//    Route::get('users/pdf',function(){
//        $pdf=PDF::loadview('admin.users.index');
//        return $pdf->download('usuarios.pdf');
//    },[
//        'as' => 'admin.users.pdf',
//    ]);
//-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
        Route::get('products/{id}/destroy',[
        'uses' => 'ProductsController@destroy',
        'as' => 'admin.products.destroy'
   	]); 
    Route::get('products/{flag}/create',[
        'uses' => 'ProductsController@create',
        'as' => 'admin.products.create'
   	]);
    Route::get('product/pdf',[
        'uses' => 'PdfController@products',
        'as' => 'admin.products.pdf'
   	]);
    Route::get('service/pdf',[
        'uses' => 'PdfController@services',
        'as' => 'admin.services.pdf'
   	]);
    Route::get('products/stats/{id}',[
        'uses' => 'ProductsController@stats',
        'as' => 'admin.products.stats'
   	]);
//-------------------------CLIENTS------------------------------------
    Route::resource('clients','AdminClientsController');
    Route::get('clients/{id}/destroy',[
        'uses' => 'AdminClientsController@destroy',
        'as' => 'admin.clients.destroy'
   	]);     
     Route::get('clients/index2/{id}',[
        'uses' => 'AdminClientsController@index2',
        'as' => 'admin.clients.index2' 
   	]);
    Route::get('clients/{id}/negotiations',[
        'uses' => 'AdminClientsController@negotiations',
        'as' => 'admin.clients.negotiations'
   	]);
    Route::get('clients/{id}/sales',[
        'uses' => 'AdminClientsController@sales',
        'as' => 'admin.clients.sales'
   	]);
    Route::get('client/pdf',[
        'uses' => 'PdfController@clients',
        'as' => 'admin.clients.pdf'
   	]);
    Route::get('clients/ticket/{id}',[
        'uses' => 'AdminClientsController@ticket',
        'as' => 'admin.clients.ticket'
   	]);
    Route::get('clients/statsclient/{id}',[
        'uses' => 'AdminClientsController@statsclient',
        'as' => 'admin.clients.statsclient'
   	]);
    Route::get('clients/statsprospect/{id}',[
        'uses' => 'AdminClientsController@statsprospec',
        'as' => 'admin.clients.statsprospect'
   	]);
    Route::get('clients/{id}/tasks',[
        'uses' => 'AdminClientsController@tasks',
        'as' => 'admin.clients.tasks'
   	]);
    Route::get('clients/createtasks/{id}',[
        'uses' => 'AdminClientsController@createtasks',
        'as' => 'admin.clients.createtasks'
   	]);
//-------------------------NEGOTIATIONS------------------------------------
    Route::resource('negotiations','AdminNegotiationsController');
    Route::get('negotiations/{id}/destroy',[
        'uses' => 'AdminNegotiationsController@destroy',
        'as' => 'admin.negotiations.destroy'
   	]); 
     Route::get('generalnegotiation/pdf',[
        'uses' => 'PdfController@generalnegotiations',
        'as' => 'admin.generalnegotiations.pdf'
   	]);
     
//-------------------------SALES------------------------------------
    Route::resource('sales','AdminSalesController');
    Route::get('sales/{id}/destroy',[
        'uses' => 'AdminSalesController@destroy',
        'as' => 'admin.Sales.destroy'
   	]); 
    Route::get('sale/pdf/{id}',[
        'uses' => 'PdfController@sales',
        'as' => 'admin.sales.pdf'
   	]);
    Route::get('generalsale/pdf',[
        'uses' => 'PdfController@generalsales',
        'as' => 'admin.generalsales.pdf'
   	]);
    Route::get('comprobantesale',[
        'uses' => 'AdminSalesController@comprobantsales',
        'as' => 'admin.sales.comprobant'
   	]);
    //-------------------------EVENTS------------------------------------
    Route::resource('events','AdminEventsController');
    Route::get('events/{id}/destroy',[
        'uses' => 'AdminEventsController@destroy',  
        'as' => 'admin.events.destroy'
   	]);
    Route::post('guardaEventos',array('as'=>'guardaEventos','uses'=>'AdminEventsController@create'));
    Route::get('cargaEventos{id?}','AdminEventsController@index2'); 
    Route::post('actualizaEventos','AdminEventsController@update');
    Route::post('eliminaEvento','AdminEventsController@delete');
    
    Route::put('eventsupdate',[
        'uses' => 'AdminEventsController@update2',
        'as' => 'admin.events.update2'
   	]);
    //-------------------------SCHEDULE------------------------------------
    Route::resource('schedule','AdminScheduleController');
    Route::get('schedule/{id}/destroy',[
        'uses' => 'AdminScheduleController@destroy',  
        'as' => 'admin.schedule.destroy'
   	]);
    
    Route::post('guardaSchedule',array('as'=>'guardaSchedule','uses'=>'AdminScheduleController@create'));
    Route::get('cargaSchedule{id?}','AdminScheduleController@index2'); 
    Route::post('actualizaSchedule','AdminScheduleController@update');
    Route::post('eliminaSchedule','AdminScheduleController@delete');
    
    Route::put('scheduleupdate',[
        'uses' => 'AdminScheduleController@update2',
        'as' => 'admin.schedule.update2'
   	]);
    ////////////////////consultar schedule de usuarios
    
    Route::post('guardaScheduleusuario/{id}',array('as'=>'guardaScheduleusuario','uses'=>'AdminScheduleController@create2'));
    Route::get('cargaScheduleusuario/{id}','AdminScheduleController@index3');  
    //-------------------------TICKETS------------------------------------
    Route::resource('tickets','TicketsAdminController');
        Route::get('tickets/{id}/destroy',[
        'uses' => 'TicketsAdminController@destroy', 
        'as' => 'admin.tickets.destroy'
   	]);
    Route::get('tickets/asignar/{id}',[
        'uses' => 'TicketsAdminController@asignar',
        'as' => 'admin.tickets.asignar'
   	]);
    Route::get('tickets/descartar/{id}',[
        'uses' => 'TicketsAdminController@descartar',
        'as' => 'admin.tickets.descartar'
   	]);
    Route::get('tickets/resuelto/{id}',[
        'uses' => 'TicketsAdminController@resuelto',
        'as' => 'admin.tickets.resuelto'
   	]);
    Route::get('tickets/pendiente/{id}',[
        'uses' => 'TicketsAdminController@pendiente',
        'as' => 'admin.tickets.pendiente'
   	]);
    Route::put('ticketsasignar/{tickets}',[
        'uses' => 'TicketsAdminController@update2',
        'as' => 'admin.tickets.update2'
   	]);
    Route::put('tickets/{tickets}',[
        'uses' => 'TicketsAdminController@update',
        'as' => 'admin.tickets.update'
   	]);
    //-------------------------CHARTS------------------------------------
//    Route::resource('charts','ChartsController');
    Route::get('charts/advisors',[
        'uses' => 'ChartsController@advisors', 
        'as' => 'admin.charts.advisors'
   	]);
    Route::get('charts/clients',[
        'uses' => 'ChartsController@clients', 
        'as' => 'admin.charts.clients'
   	]);
    Route::get('charts/negotiations',[
        'uses' => 'ChartsController@negotiations', 
        'as' => 'admin.charts.negotiations'
   	]);
    Route::get('charts/sales',[
        'uses' => 'ChartsController@sales', 
        'as' => 'admin.charts.sales'
   	]);
    Route::get('charts/products',[
        'uses' => 'ChartsController@products', 
        'as' => 'admin.charts.products'
   	]);
    Route::get('charts/tickets',[
        'uses' => 'ChartsController@tickets', 
        'as' => 'admin.charts.tickets'
   	]);
    ////////////////////////////////////////////// asesores
    Route::get('grafica_clientes/{anio}/{mes}', 'ChartsController@clientes_mes');
    Route::get('grafica_ventas/{anio}/{mes}', 'ChartsController@ventas_mes');
    Route::get('grafica_total_clientes/{anio}/{mes}', 'ChartsController@total_clientes');
    Route::get('grafica_total_ventas/{anio}/{mes}', 'ChartsController@total_ventas');
    Route::get('grafica_asesor_con_mas_clientes/{anio}/{mes}', 'ChartsController@grafica_asesor_con_mas_clientes');
    Route::get('grafica_asesor_con_menos_clientes/{anio}/{mes}', 'ChartsController@grafica_asesor_con_menos_clientes');
    Route::get('grafica_asesor_con_mas_prospectos/{anio}/{mes}', 'ChartsController@grafica_asesor_con_mas_prospectos');
    Route::get('grafica_asesor_con_menos_prospectos/{anio}/{mes}', 'ChartsController@grafica_asesor_con_menos_prospectos');
    Route::get('grafica_asesor_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_asesor_con_mas_ventas');
    Route::get('grafica_asesor_con_menos_ventas/{anio}/{mes}', 'ChartsController@grafica_asesor_con_menos_ventas');
    Route::get('grafica_asesor_con_mas_negociaciones/{anio}/{mes}', 'ChartsController@grafica_asesor_con_mas_negociaciones');
    Route::get('grafica_asesor_con_menos_negociaciones/{anio}/{mes}', 'ChartsController@grafica_asesor_con_menos_negociaciones');
    Route::get('grafica_asesor_con_mas_perdidas/{anio}/{mes}', 'ChartsController@grafica_asesor_con_mas_perdidas');
    Route::get('grafica_clientes_anuales/{anio}/{id}', 'ChartsController@clientes_anuales'); ///
    Route::get('grafica_ventas_anuales/{anio}/{id}', 'ChartsController@ventas_anuales'); ///
    //////////////////////////////////////////////// Prospectos/CLientes
    Route::get('grafica_cliente_con_mas_referidos/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_referidos');
    Route::get('grafica_cliente_con_mas_negociaciones/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_negociaciones');
    Route::get('grafica_cliente_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_ventas');
    Route::get('grafica_cliente_con_mas_tickets/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_tickets');
    Route::get('grafica_ventas_anuales_cliente/{anio}/{id}', 'ChartsController@ventas_anuales_cliente');
    Route::get('grafica_referidos_anuales_cliente/{anio}/{id}', 'ChartsController@referidos_anuales_cliente'); 
    Route::get('grafica_tickets_anuales_cliente/{anio}/{id}', 'ChartsController@tickets_anuales_cliente'); 
    //////////////////////////////////////////////// negociaciones
    Route::get('grafica_negociaciones_anuales/{anio}', 'ChartsController@negociaciones_anuales'); 
    //////////////////////////////////////////////// ventas
    Route::get('grafica_venta_anual/{anio}', 'ChartsController@venta_anual');
    Route::get('grafica_ingreso_anual/{anio}', 'ChartsController@ingreso_anual'); 
    //////////////////////////////////////////////// producto
    Route::get('grafica_producto_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_producto_con_mas_ventas');
    Route::get('grafica_producto_con_menos_ventas/{anio}/{mes}', 'ChartsController@grafica_producto_con_menos_ventas');
    Route::get('grafica_servicio_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_servicio_con_mas_ventas');
    Route::get('grafica_servicio_con_menos_ventas/{anio}/{mes}', 'ChartsController@grafica_servicio_con_menos_ventas');
    Route::get('grafica_productos_anuales/{anio}/{id}', 'ChartsController@productos_anuales'); ///
    //////////////////////////////////////////////// Tickets
    Route::get('grafica_ticket_anual/{anio}', 'ChartsController@ticket_anual');
    Route::get('grafica_tecnico_con_mas_tickets_resueltos/{anio}/{mes}', 'ChartsController@grafica_tecnico_con_mas_tickets_resueltos');
    Route::get('grafica_tecnico_con_mas_tickets_pendientes', 'ChartsController@grafica_tecnico_con_mas_tickets_pendientes');
    
    //-------------------------Task------------------------------------
    Route::resource('tasks','AdminTaskController');
    Route::get('tasks/{id}/destroy',[
        'uses' => 'AdminTaskController@destroy',  
        'as' => 'admin.tasks.destroy'
   	]);
    //----------------------Mails---------------------------------------
    Route::resource('emails','AdminMailcontroller');
//    Route::get('enviar',function(){
//        Mail::send('emails.index',[],function($message){
//            $message->from('admin@tellmeyes.com','ADMIN');
//            $message->to('franklindavid91@gmail.com','franklin david')->subject('Alerta desde admin');
//        });
//    });
//    Route::get('enviarvarios',function(){
//        $users = App\User::all();
//        foreach ($users as $user){
//            Mail::send('emails.index',['user'=> $user],function($message) use ($user){
//                $message->from('admin@tellmeyes.com','ADMIN');
//                $message->to($user->email,$user->name)->subject('Alerta desde admin');
//            });
//        }
//    });
    //--------------------password-----------------------------
    Route::resource('passwords','PasswordController');
    });
////////////////////////////////ADVISOR/////////////////////////////////
Route::group(['prefix'=>'advisor','middleware'=>['auth','AdvisorMiddleware']],function(){
//-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
    Route::get('products',[
        'uses' => 'ProductsController@showProductAdvisor',
        'as' => 'advisor.products.showProductAdvisor'
   	]); 
    Route::get('product/pdf',[
        'uses' => 'PdfController@products',
        'as' => 'admin.products.pdf'
   	]);
    Route::get('service/pdf',[
        'uses' => 'PdfController@services',
        'as' => 'admin.services.pdf'
   	]);
//-------------------------CLIENTS------------------------------------
    Route::resource('clients','ClientsController');
        Route::get('clients/{id}/destroy',[
        'uses' => 'ClientsController@destroy', 
        'as' => 'advisor.clients.destroy'
   	]);    
    
    Route::get('clients/{id}/details',[
        'uses' => 'ClientsController@details',
        'as' => 'advisor.clients.details'
   	]);
    Route::get('clients/{id}/negotiations',[
        'uses' => 'ClientsController@negotiations',
        'as' => 'advisor.clients.negotiations'
   	]);
    Route::get('clients/{id}/sales',[
        'uses' => 'ClientsController@sales',
        'as' => 'advisor.clients.sales'
   	]);
    Route::get('clients/{id}/tasks',[
        'uses' => 'ClientsController@tasks',
        'as' => 'advisor.clients.tasks'
   	]);
    Route::get('clients/createnegotiations/{id}',[
        'uses' => 'ClientsController@createnegotiations',
        'as' => 'advisor.clients.createnegotiations'
   	]); 
    Route::get('clients/createsales/{id}',[
        'uses' => 'ClientsController@createsales',
        'as' => 'advisor.clients.createsales'
   	]);
    Route::get('clients/createtasks/{id}',[
        'uses' => 'ClientsController@createtasks',
        'as' => 'advisor.clients.createtasks'
   	]);
    Route::get('clients/create2/{id}',[
        'uses' => 'ClientsController@create2',
        'as' => 'advisor.clients.create2'
   	]); 
    Route::get('clients/index2/{id}',[
        'uses' => 'ClientsController@index2',
        'as' => 'advisor.clients.index2'
   	]); 
    Route::post('referreds',[
        'uses' => 'ClientsController@store2',
        'as' => 'advisor.referreds.store2'
   	]); 
    Route::post('clientnegotiation',[
        'uses' => 'ClientsController@storenegotiation',
        'as' => 'advisor.negotiation.storenegotiation'
   	]); 
    Route::post('clientsale',[
        'uses' => 'ClientsController@storesale',
        'as' => 'advisor.negotiation.storesale'
   	]); 
    Route::get('client/pdf',[
        'uses' => 'PdfController@clientsadvisor',
        'as' => 'advisor.clientsadvisor.pdf'
   	]);
    Route::get('clients/statsclient/{id}',[
        'uses' => 'ClientsController@statsclient',
        'as' => 'advisor.clients.statsclient'
   	]);
    Route::get('clients/statsprospect/{id}',[
        'uses' => 'ClientsController@statsprospec',
        'as' => 'advisor.clients.statsprospect'
   	]);
//-------------------------NEGOTIATIONS------------------------------------
    Route::resource('negotiations','NegotiationsController');
    Route::get('negotiations/{id}/destroy',[
        'uses' => 'NegotiationsController@destroy', 
        'as' => 'advisor.negotiations.destroy'
   	]); 
    Route::get('negotiation/pdf',[
        'uses' => 'PdfController@negotiationadvisor',
        'as' => 'admin.negotiationadvisor.pdf'
   	]);
//-------------------------SALES------------------------------------
    Route::resource('sales','SalesController');
    Route::get('sales/{id}/destroy',[
        'uses' => 'SalesController@destroy', 
        'as' => 'advisor.sales.destroy'
   	]); 
    Route::get('generalsale/pdf',[
        'uses' => 'PdfController@generalsaleadvisor',
        'as' => 'admin.generalsaleadvisor.pdf'
   	]);
    Route::get('sale/pdf/{id}',[
        'uses' => 'PdfController@salesadvisor',
        'as' => 'advisor.sales.pdf'
   	]);
    Route::get('comprobantesale',[
        'uses' => 'SalesController@comprobantsales',
        'as' => 'advisor.sales.comprobant'
   	]);
    //-------------------------EVENTS------------------------------------
    Route::resource('events','AdvisorEventsController');
    Route::get('events/{id}/destroy',[
        'uses' => 'AdvisorEventsController@destroy',  
        'as' => 'advisor.events.destroy'
   	]);
    Route::post('guardaEventos',array('as'=>'guardaEventos','uses'=>'AdvisorEventsController@create'));
    Route::get('cargaEventos{id?}','AdvisorEventsController@index2'); 
    Route::post('actualizaEventos','AdvisorEventsController@update');
    Route::post('eliminaEvento','AdvisorEventsController@delete');
    
    Route::put('eventsupdate',[
        'uses' => 'AdvisorEventsController@update2',
        'as' => 'advisor.events.update2'
   	]);
    //-------------------------SCHEDULE------------------------------------
    Route::resource('schedule','AdvisorScheduleController');
    Route::get('schedule/{id}/destroy',[
        'uses' => 'AdvisorScheduleController@destroy',  
        'as' => 'advisor.schedule.destroy'
   	]);
    
    Route::post('guardaSchedule',array('as'=>'guardaSchedule','uses'=>'AdvisorScheduleController@create'));
    Route::get('cargaSchedule{id?}','AdvisorScheduleController@index2'); 
    Route::post('actualizaSchedule','AdvisorScheduleController@update');
    Route::post('eliminaSchedule','AdvisorScheduleController@delete');
    
    Route::put('scheduleupdate',[
        'uses' => 'AdvisorScheduleController@update2',
        'as' => 'advisor.schedule.update2'
   	]);
    //-------------------------CHARTS------------------------------------
    Route::get('charts',[
        'uses' => 'ChartsController@indexadvisor', 
        'as' => 'advisor.charts.index'
   	]);
//////////////////////////////////////////////// Prospectos/CLientes
    Route::get('grafica_cliente_con_mas_referidos/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_referidos');
    Route::get('grafica_cliente_con_mas_negociaciones/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_negociaciones');
    Route::get('grafica_cliente_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_ventas');
    Route::get('grafica_cliente_con_mas_tickets/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_tickets');
    Route::get('grafica_ventas_anuales_cliente/{anio}/{id}', 'ChartsController@ventas_anuales_cliente');
    Route::get('grafica_referidos_anuales_cliente/{anio}/{id}', 'ChartsController@referidos_anuales_cliente'); 
    Route::get('grafica_tickets_anuales_cliente/{anio}/{id}', 'ChartsController@tickets_anuales_cliente'); 
    
    //////////////////////////////////////////// mis estadisticas
    Route::get('grafica_clientes_individual/{anio}/{mes}', 'ChartsController@clientes_mes_individual');
    Route::get('grafica_total_clientes_individual/{anio}/{mes}', 'ChartsController@total_clientes_individual');
    Route::get('grafica_cliente_con_mas_ventas_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_ventas_individual');
    Route::get('grafica_cliente_con_mas_negociaciones_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_negociaciones_individual');
    Route::get('grafica_cliente_con_mas_referidos_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_referidos_individual');
    
    Route::get('grafica_negociaciones_anuales/{anio}', 'ChartsController@negociaciones_anuales_individual'); 
    Route::get('grafica_venta_anual/{anio}', 'ChartsController@venta_anual_individual');
    //-------------------------Task------------------------------------
    Route::resource('tasks','TaskController');
    Route::get('tasks/{id}/destroy',[
        'uses' => 'TaskController@destroy',  
        'as' => 'advisor.tasks.destroy'
   	]);
//    Route::get('clients/{id}/task',[
//        'uses' => 'TaskController@taskclient',
//        'as' => 'advisor.clients.taskclient'
//   	]);
    //----------------------Mails---------------------------------------
    Route::resource('emails','AdvisorMailcontroller');
    //--------------------password-----------------------------
    
    Route::resource('passwords','PasswordController');
    
//    Route::get('users/password/{id}',[
//        'uses' => 'UsersController@password',
//        'as' => 'advisor.users.password'
//   	]);
//    Route::put('userspassword/{users}',[
//        'uses' => 'UsersController@update2',
//        'as' => 'advisor.users.update2'
//   	]);
    
});
////////////////////////////////SALES MANAGER/////////////////////////////////
Route::group(['prefix'=>'salesmanager','middleware'=>['auth','SalesManagerMiddleware']],function(){
    //-------------------------ADVISORS------------------------------------
    Route::resource('advisors','AdvisorsController');
    Route::get('advisors/{id}/destroy',[
        'uses' => 'AdvisorsController@destroy', 
        'as' => 'salesmanager.advisors.destroy'
   	]);
    Route::get('advisors/index2/{id}',[
        'uses' => 'AdvisorsController@index2',
        'as' => 'salesmanager.advisors.index2'
   	]);
    Route::get('advisors/negociacion/{id}',[
        'uses' => 'AdvisorsController@negociacion',
        'as' => 'salesmanager.advisors.negociacion'
   	]);
    Route::get('advisors/venta/{id}',[
        'uses' => 'AdvisorsController@venta',
        'as' => 'salesmanager.advisors.venta'
   	]);
    Route::get('advisors/referreds/{id}',[ 
        'uses' => 'AdvisorsController@referreds',
        'as' => 'salesmanager.advisors.referreds'
   	]); 
    Route::get('advisors/negotiations/{id}',[
        'uses' => 'AdvisorsController@negotiations',
        'as' => 'salesmanager.advisors.negotiations'
   	]);
    Route::get('advisors/sale/{id}',[ 
        'uses' => 'AdvisorsController@sales',
        'as' => 'salesmanager.advisors.sales'
   	]);
    Route::get('advisors/clientedit/{id}',[
        'uses' => 'AdvisorsController@clients',
        'as' => 'salesmanager.advisors.clients'
   	]);
    Route::put('advisors/clientupdate/{clients}',[
        'uses' => 'AdvisorsController@updateclients',
        'as' => 'salesmanager.advisors.updateclients'
   	]);
    Route::get('advisor/pdf',[
        'uses' => 'PdfController@advisor',
        'as' => 'salesmanager.advisors.pdf'
   	]);
    Route::get('advisors/stats/{id}',[
        'uses' => 'AdvisorsController@stats',
        'as' => 'salesmanager.advisors.stats'
   	]);
    Route::get('advisors/{id}/tasks',[
        'uses' => 'AdvisorsController@tasks',
        'as' => 'salesmanager.advisors.tasks'
   	]);
    Route::get('advisors/createtasks/{id}',[
        'uses' => 'AdvisorsController@createtasks',
        'as' => 'salesmanager.advisors.createtasks'
   	]);
    Route::get('advisors/{id}/schedules',[
        'uses' => 'AdvisorsController@schedules',
        'as' => 'salesmanager.advisors.schedules'
   	]);
    //-------------------------CLIENTS------------------------------------
    Route::resource('clients','SalesManagerClientsController');
        Route::get('clients/{id}/destroy',[
        'uses' => 'SalesManagerClientsController@destroy', 
        'as' => 'salesmanager.clients.destroy'
   	]);    
    
    Route::get('clients/{id}/details',[
        'uses' => 'SalesManagerClientsController@details',
        'as' => 'salesmanager.clients.details'
   	]);
    Route::get('clients/{id}/edit2',[
        'uses' => 'SalesManagerClientsController@edit2',
        'as' => 'salesmanager.clients.edit2'
   	]);
    Route::get('clients/{id}/negotiations',[
        'uses' => 'SalesManagerClientsController@negotiations',
        'as' => 'salesmanager.clients.negotiations'
   	]);
    Route::get('clients/{id}/sales',[
        'uses' => 'SalesManagerClientsController@sales',
        'as' => 'salesmanager.clients.sales'
   	]);
    Route::get('clients/createnegotiations/{id}',[
        'uses' => 'SalesManagerClientsController@createnegotiations',
        'as' => 'salesmanager.clients.createnegotiations'
   	]);
    Route::get('clients/createsales/{id}',[
        'uses' => 'SalesManagerClientsController@createsales',
        'as' => 'salesmanager.clients.createsales'
   	]);
    Route::get('clients/create2/{id}',[
        'uses' => 'SalesManagerClientsController@create2',
        'as' => 'salesmanager.clients.create2'
   	]); 
    Route::get('clients/index2/{id}',[ 
        'uses' => 'SalesManagerClientsController@index2',
        'as' => 'salesmanager.clients.index2'
   	]); 
    Route::post('referreds',[
        'uses' => 'SalesManagerClientsController@store2',
        'as' => 'salesmanager.referreds.store2'
   	]); 
    Route::post('clientnegotiation',[
        'uses' => 'SalesManagerClientsController@storenegotiation',
        'as' => 'salesmanager.negotiation.storenegotiation'
   	]); 
    Route::get('generalclients',[ 
        'uses' => 'SalesManagerClientsController@generalclients',
        'as' => 'salesmanager.generalclients.index'
   	]); 
    Route::get('client/pdf',[
        'uses' => 'PdfController@clientsadvisor',
        'as' => 'salesmanager.clients.pdf'
   	]);
    Route::get('generalclient/pdf',[
        'uses' => 'PdfController@clients',
        'as' => 'salesmanager.generalclients.pdf'
   	]);
    Route::get('clients/statsclient/{id}',[
        'uses' => 'SalesManagerClientsController@statsclient',
        'as' => 'salesmanager.clients.statsclient'
   	]);
    Route::get('clients/statsprospect/{id}',[
        'uses' => 'SalesManagerClientsController@statsprospec',
        'as' => 'salesmanager.clients.statsprospect'
   	]);
    Route::get('clients/{id}/tasks',[
        'uses' => 'SalesManagerClientsController@tasks',
        'as' => 'salesmanager.clients.tasks'
   	]);
    Route::get('clients/createtasks/{id}',[
        'uses' => 'SalesManagerClientsController@createtasks',
        'as' => 'salesmanager.clients.createtasks'
   	]);
    //-------------------------NEGOTIATIONS------------------------------------
    Route::resource('negotiations','SalesManagerNegotiationsController');
    Route::get('negotiations/{id}/destroy',[
        'uses' => 'SalesManagerNegotiationsController@destroy', 
        'as' => 'salesmanager.negotiations.destroy'
   	]); 
    Route::get('negotiation/pdf',[
        'uses' => 'PdfController@negotiationadvisor',
        'as' => 'salesmanager.negotiationsalesmanager.pdf'
   	]);
//-------------------------SALES------------------------------------
    Route::resource('sales','SalesManagerSalesController');
    Route::get('sales/{id}/destroy',[
        'uses' => 'SalesManagerSalesController@destroy', 
        'as' => 'salesmanager.sales.destroy'
   	]); 
    Route::get('generalsale/pdf',[
        'uses' => 'PdfController@generalsaleadvisor',
        'as' => 'salesmanager.generalsaleadvisor.pdf'
   	]);
    Route::get('sale/pdf/{id}',[
        'uses' => 'PdfController@salesadvisor',
        'as' => 'salesmanager.sales.pdf'
   	]);
    Route::get('comprobantesale',[
        'uses' => 'SalesManagerSalesController@comprobantsales',
        'as' => 'salesmanager.sales.comprobant'
   	]);
    //-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
    Route::get('products',[
        'uses' => 'ProductsController@showProductSalesManager',
        'as' => 'salesmanager.products.showProductSalesManager'
   	]); 
    Route::get('product/pdf',[
        'uses' => 'PdfController@products',
        'as' => 'admin.products.pdf'
   	]);
    Route::get('service/pdf',[
        'uses' => 'PdfController@services',
        'as' => 'admin.services.pdf'
   	]);
    //-------------------------EVENTS------------------------------------
    Route::resource('events','SalesManagerEventsController');
    Route::get('events/{id}/destroy',[
        'uses' => 'SalesManagerEventsController@destroy',  
        'as' => 'salesmanager.events.destroy'
   	]);
    Route::post('guardaEventos',array('as'=>'guardaEventos','uses'=>'SalesManagerEventsController@create'));
    Route::get('cargaEventos{id?}','SalesManagerEventsController@index2'); 
    Route::post('actualizaEventos','SalesManagerEventsController@update');
    Route::post('eliminaEvento','SalesManagerEventsController@delete');
    
    Route::put('eventsupdate',[
        'uses' => 'SalesManagerEventsController@update2',
        'as' => 'salesmanager.events.update2'
   	]);
    //-------------------------SCHEDULE------------------------------------
    Route::resource('schedule','SalesManagerScheduleController');
    Route::get('schedule/{id}/destroy',[
        'uses' => 'SalesManagerScheduleController@destroy',  
        'as' => 'salesmanager.schedule.destroy'
   	]);
    
    Route::post('guardaSchedule',array('as'=>'guardaSchedule','uses'=>'SalesManagerScheduleController@create'));
    Route::get('cargaSchedule{id?}','SalesManagerScheduleController@index2'); 
    Route::post('actualizaSchedule','SalesManagerScheduleController@update');
    Route::post('eliminaSchedule','SalesManagerScheduleController@delete');
    
    Route::put('scheduleupdate',[
        'uses' => 'SalesManagerScheduleController@update2',
        'as' => 'salesmanager.schedule.update2'
   	]);
    ////////////////////consultar schedule de usuarios
    
    Route::post('guardaScheduleusuario/{id}',array('as'=>'guardaScheduleusuario','uses'=>'SalesManagerScheduleController@create2'));
    Route::get('cargaScheduleusuario/{id}','SalesManagerScheduleController@index3');  
    //------------------------CHARTS----------------------------------------
    Route::get('charts',[
        'uses' => 'ChartsController@indexsalesmanager', 
        'as' => 'salesmanager.charts.index'
   	]); 
    Route::get('grafica_clientes_anuales/{anio}/{id}', 'ChartsController@clientes_anuales'); ///
    Route::get('grafica_ventas_anuales/{anio}/{id}', 'ChartsController@ventas_anuales'); ///
    Route::get('grafica_ventas_anuales_cliente/{anio}/{id}', 'ChartsController@ventas_anuales_cliente');
    Route::get('grafica_referidos_anuales_cliente/{anio}/{id}', 'ChartsController@referidos_anuales_cliente'); 
    Route::get('grafica_tickets_anuales_cliente/{anio}/{id}', 'ChartsController@tickets_anuales_cliente'); 
    //////////////////////////////////////////// mis estadisticas
    Route::get('grafica_clientes_individual/{anio}/{mes}', 'ChartsController@clientes_mes_individual');
    Route::get('grafica_total_clientes_individual/{anio}/{mes}', 'ChartsController@total_clientes_individual');
    Route::get('grafica_cliente_con_mas_ventas_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_ventas_individual');
    Route::get('grafica_cliente_con_mas_negociaciones_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_negociaciones_individual');
    Route::get('grafica_cliente_con_mas_referidos_individual/{anio}/{mes}', 'ChartsController@grafica_cliente_con_mas_referidos_individual');
    
    Route::get('grafica_negociaciones_anuales/{anio}', 'ChartsController@negociaciones_anuales_individual'); 
    Route::get('grafica_venta_anual/{anio}', 'ChartsController@venta_anual_individual');
    
    Route::get('grafica_clientes/{anio}/{mes}', 'ChartsController@clientes_mes');
    Route::get('grafica_venta_anual_home/{anio}', 'ChartsController@venta_anual');
    //-------------------------Task------------------------------------
    Route::resource('tasks','SalesManagerTasksController');
    Route::get('tasks/{id}/destroy',[
        'uses' => 'SalesManagerTasksController@destroy',  
        'as' => 'salesmanager.tasks.destroy'
   	]);
    //----------------------Mails---------------------------------------
    Route::resource('emails','SalesManagerMailcontroller');
    
    //--------------------password-----------------------------
    Route::resource('passwords','PasswordController');
});
////////////////////////////////MArketing MANAGER/////////////////////////////////
Route::group(['prefix'=>'marketingmanager','middleware'=>['auth','MarketingManagerMiddleware']],function(){
     //-------------------------ADVISORS------------------------------------
    Route::resource('advisors','MarketingManagerAdvisorController');
    Route::get('advisors/{id}/destroy',[
        'uses' => 'MarketingManagerAdvisorController@destroy', 
        'as' => 'marketingmanager.advisors.destroy'
        ]);
    Route::get('advisors/index2/{id}',[
        'uses' => 'MarketingManagerAdvisorController@index2',
        'as' => 'marketingmanager.advisors.index2'
   	]);
    Route::get('advisors/negociacion/{id}',[
        'uses' => 'MarketingManagerAdvisorController@negociacion',
        'as' => 'marketingmanager.advisors.negociacion'
   	]);
    Route::get('advisors/venta/{id}',[
        'uses' => 'MarketingManagerAdvisorController@venta',
        'as' => 'marketingmanager.advisors.venta'
   	]);
    Route::get('advisor/pdf',[
        'uses' => 'PdfController@advisor',
        'as' => 'salesmanager.advisors.pdf'
   	]);
    //-------------------------CLIENTS------------------------------------
    Route::resource('clients','MarketingManagerClientsController');
    Route::get('clients/{id}/details',[
        'uses' => 'MarketingManagerClientsController@details',
        'as' => 'marketingmanager.clients.details'
   	]);
    Route::get('clients/{id}/negotiations',[
        'uses' => 'MarketingManagerClientsController@negotiations',
        'as' => 'marketingmanager.clients.negotiations'
   	]);
    Route::get('clients/{id}/sales',[
        'uses' => 'MarketingManagerClientsController@sales',
        'as' => 'marketingmanager.clients.sales'
   	]);
    Route::get('clients/index2/{id}',[ 
        'uses' => 'MarketingManagerClientsController@index2',
        'as' => 'marketingmanager.clients.index2'
   	]); 
    Route::get('generalclient/pdf',[
        'uses' => 'PdfController@clients',
        'as' => 'marketingmanager.generalclients.pdf'
   	]);
    //-------------------------NEGOTIATIONS------------------------------------
    Route::resource('negotiations','MarketingManagerNegotiationsController');
//-------------------------SALES------------------------------------
    Route::resource('sales','MarketingManagerSalesController');
    //-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
    Route::get('products',[
        'uses' => 'ProductsController@showProductMarketingManager',
        'as' => 'marketingmanager.products.showProductMarketingManager'
   	]); 
    Route::get('product/pdf',[
        'uses' => 'PdfController@products',
        'as' => 'admin.products.pdf'
   	]);
    Route::get('service/pdf',[
        'uses' => 'PdfController@services',
        'as' => 'admin.services.pdf'
   	]);
    //-------------------------EVENTS------------------------------------
    Route::resource('events','EventsController');
    Route::get('events/{id}/destroy',[
        'uses' => 'EventsController@destroy',  
        'as' => 'marketingmanager.events.destroy'
   	]);
    Route::post('guardaEventos',array('as'=>'guardaEventos','uses'=>'EventsController@create'));
    Route::get('cargaEventos{id?}','EventsController@index2'); 
    Route::post('actualizaEventos','EventsController@update');
    Route::post('eliminaEvento','EventsController@delete');
    
    Route::put('eventsupdate',[
        'uses' => 'EventsController@update2',
        'as' => 'marketingmanager.events.update2'
   	]);
    //-------------------------SCHEDULE------------------------------------
    Route::resource('schedule','ScheduleController');
    Route::get('schedule/{id}/destroy',[
        'uses' => 'ScheduleController@destroy',  
        'as' => 'marketingmanager.schedule.destroy'
   	]);
    
    Route::post('guardaSchedule',array('as'=>'guardaSchedule','uses'=>'ScheduleController@create'));
    Route::get('cargaSchedule{id?}','ScheduleController@index2'); 
    Route::post('actualizaSchedule','ScheduleController@update');
    Route::post('eliminaSchedule','ScheduleController@delete');
    
    Route::put('scheduleupdate',[
        'uses' => 'ScheduleController@update2',
        'as' => 'marketingmanager.schedule.update2'
   	]);
    //-------------------------CHARTS------------------------------------
    Route::get('charts',[
        'uses' => 'ChartsController@indexmarketingmanager', 
        'as' => 'marketingmanager.charts.index'
   	]);
    //////////////////////////////////////////////// ventas
    Route::get('grafica_venta_anual/{anio}', 'ChartsController@venta_anual');
    /////////////////////////////////////////////// producto/servicio
    Route::get('grafica_producto_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_producto_con_mas_ventas');
    Route::get('grafica_producto_con_menos_ventas/{anio}/{mes}', 'ChartsController@grafica_producto_con_menos_ventas');
    Route::get('grafica_servicio_con_mas_ventas/{anio}/{mes}', 'ChartsController@grafica_servicio_con_mas_ventas');
    Route::get('grafica_servicio_con_menos_ventas/{anio}/{mes}', 'ChartsController@grafica_servicio_con_menos_ventas');
    //----------------------Mails---------------------------------------
    Route::resource('emails','MarketingManagerMailcontroller');
    //--------------------password-----------------------------
    Route::resource('passwords','PasswordController');
        
});
////////////////////////////////Costumer Service MANAGER/////////////////////////////////
Route::group(['prefix'=>'costumerservicemanager','middleware'=>['auth','CostumerServiceManagerMiddleware']],function(){
    //-------------------------technical------------------------------------
       Route::resource('technicals','TechnicalsController');
        Route::get('technicals/{id}/destroy',[
        'uses' => 'TechnicalsController@destroy', 
        'as' => 'costumerservicemanager.technicals.destroy'
   	]);
    Route::get('technicals/ticket/{id}',[
        'uses' => 'TechnicalsController@ticket',
        'as' => 'costumerservicemanager.technicals.ticket'
   	]);
    //-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
    Route::get('products',[
        'uses' => 'ProductsController@showProductCostumerServiceManager',
        'as' => 'costumerservicemanager.products.showProductCostumerServiceManager'
   	]); 
    //-------------------------TICKETS------------------------------------
    Route::resource('tickets','TicketsController');
        Route::get('tickets/{id}/destroy',[
        'uses' => 'TicketsController@destroy', 
        'as' => 'costumerservicemanager.tickets.destroy'
   	]);
    Route::get('tickets/asignar/{id}',[
        'uses' => 'TicketsController@asignar',
        'as' => 'costumerservicemanager.tickets.asignar'
   	]);
    Route::get('tickets/descartar/{id}',[
        'uses' => 'TicketsController@descartar',
        'as' => 'costumerservicemanager.tickets.descartar'
   	]);
    Route::get('tickets/resuelto/{id}',[
        'uses' => 'TicketsController@resuelto',
        'as' => 'costumerservicemanager.tickets.resuelto'
   	]);
    Route::get('tickets/pendiente/{id}',[
        'uses' => 'TicketsController@pendiente',
        'as' => 'costumerservicemanager.tickets.pendiente'
   	]);
    Route::put('ticketsasignar/{tickets}',[
        'uses' => 'TicketsController@update2',
        'as' => 'costumerservicemanager.tickets.update2'
   	]);
    Route::put('tickets/{tickets}',[
        'uses' => 'TicketsController@update',
        'as' => 'costumerservicemanager.tickets.update'
   	]);
    //-------------------------clients------------------------------------
    Route::resource('clients','CostumerServiceClientsController');
    Route::get('clients/ticket/{id}',[
        'uses' => 'CostumerServiceClientsController@ticket',
        'as' => 'costumerservicemanager.clients.ticket'
   	]);
    //-------------------------CHARTS------------------------------------
    Route::get('charts',[
        'uses' => 'ChartsController@indexcostumerservicemanager', 
        'as' => 'costumerservicemanager.charts.index'
   	]);
    //////////////////////////////////////////////// Tickets
    Route::get('grafica_ticket_anual/{anio}', 'ChartsController@ticket_anual');
    Route::get('grafica_tecnico_con_mas_tickets_resueltos/{anio}/{mes}', 'ChartsController@grafica_tecnico_con_mas_tickets_resueltos');
    Route::get('grafica_tecnico_con_mas_tickets_pendientes', 'ChartsController@grafica_tecnico_con_mas_tickets_pendientes');
    //----------------------Mails---------------------------------------
    Route::resource('emails','CostumerServiceMailcontroller');
    //--------------------password-----------------------------
    Route::resource('passwords','PasswordController');
});
////////////////////////////////TECHNICAL/////////////////////////////////
Route::group(['prefix'=>'technical','middleware'=>['auth','TechnicalMiddleware']],function(){
    //-------------------------TICKETS------------------------------------
    Route::resource('tickets','TechnicalTicketController');
    
    Route::get('tickets/technicalresuelto/{id}',[
        'uses' => 'TechnicalTicketController@resuelto',
        'as' => 'technical.tickets.resuelto'
   	]);
    Route::get('tickets/technicalpendiente/{id}',[
        'uses' => 'TechnicalTicketController@pendiente',
        'as' => 'technical.tickets.pendiente' 
   	]);
    Route::get('ticket/pdf',[
        'uses' => 'PdfController@ticketspendientes',
        'as' => 'technical.tickets.pdf'
   	]);
    Route::get('/clients/{clients}',[
        'uses' => 'CostumerServiceClientsController@show',
        'as' => 'technical.clients.show'
   	]);
    //-------------------------PRODUCTS------------------------------------
    Route::resource('products','ProductsController');
    Route::get('products',[
        'uses' => 'ProductsController@showProductTechnical',
        'as' => 'technical.products.showProductTechnical'
   	]); 
    //-------------------------clients------------------------------------
    Route::resource('clients','TechnicalClientsController');
    Route::get('clients/ticket/{id}',[
        'uses' => 'TechnicalClientsController@ticket',
        'as' => 'technical.clients.ticket'
   	]);
    //-------------------------SCHEDULE------------------------------------
    Route::resource('schedule','TechnicalScheduleController');
    Route::get('schedule/{id}/destroy',[
        'uses' => 'TechnicalScheduleController@destroy',  
        'as' => 'technical.schedule.destroy'
   	]);
    
    Route::post('guardaSchedule',array('as'=>'guardaSchedule','uses'=>'TechnicalScheduleController@create'));
    Route::get('cargaSchedule{id?}','TechnicalScheduleController@index2'); 
    Route::post('actualizaSchedule','TechnicalScheduleController@update');
    Route::post('eliminaSchedule','TechnicalScheduleController@delete');
    
    Route::put('scheduleupdate',[
        'uses' => 'TechnicalScheduleController@update2',
        'as' => 'technical.schedule.update2'
   	]);
    //--------------------password-----------------------------
    Route::resource('passwords','PasswordController');
});