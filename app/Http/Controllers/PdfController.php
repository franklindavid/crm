<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PDF;
use App\User;
use App\Product;
use App\Client;
use App\Negotiation;
use App\Ticket;
use Auth;
use DB; 

class PdfController extends Controller
{
    public function users(Request $request){
        $users=User::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('type', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->get();
         $view =  \View::make('admin.users.pdf', compact('users'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->download('usuarios.pdf');
//        return $pdf->stream('reporte');
    }
    public function products(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->where('flag', '=', 1)->get();
         $view =  \View::make('admin.products.productspdf', compact('products'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('productos.pdf');
//        return $pdf->stream('reporte');
    } 
    public function services(Request $request){
        $services=Product::where('name', 'LIKE', '%'.$request->name.'%')->where('flag', '=', 0)->get();
         $view =  \View::make('admin.products.servicespdf', compact('services'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('servicio.pdf');
//        return $pdf->stream('reporte');
    }
    public function clients(Request $request){
        $clients=Client::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->get();
         $view =  \View::make('admin.clients.pdf', compact('clients'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('clientes.pdf');
//        return $pdf->stream('reporte');
    }
    public function generalnegotiations(Request $request){
        $negotiations = Negotiation::where('estado', '!=', 'ganada')->get();
         $view =  \View::make('admin.negotiations.generalpdf', compact('negotiations'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('negociaciones.pdf');
//        return $pdf->stream('reporte');
    } 
    public function sales($id){ 
        $negotiation = Negotiation::find($id);
//        dd($negotiations);
         $view =  \View::make('admin.sales.pdf', compact('negotiation'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('comprobanteventa.pdf');
//        return $pdf->stream('reporte');
    }
    public function generalsales(Request $request){
        $negotiations = Negotiation::where('estado', '=', 'ganada')->get();
         $view =  \View::make('admin.sales.generalpdf', compact('negotiations'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('ventas.pdf');
//        return $pdf->stream('reporte');
    }
    public function clientsadvisor(Request $request){
        $clients = Client::where('cedula','LIKE',"%$request->name%")->where('user_id', '=', Auth::user()->id)->get();
//        dd('hola putio');
        $view =  \View::make('advisor.clients.pdf', compact('clients'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('clientes.pdf');
//        return $pdf->stream('reporte');
    }
    public function negotiationadvisor(Request $request){
        $negotiations = DB::table('negotiations as n')
            ->join('clients as c','n.client_id','=','c.id')
            ->select('n.id','n.user_id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion','n.created_at')
            ->where('n.user_id', '=', Auth::user()->id)->where('n.estado', '!=', 'ganada')->where('cedula', 'LIKE', '%'.$request->name.'%')->get();
        $view =  \View::make('advisor.negotiations.pdf', compact('negotiations'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('negociaciones.pdf');
//        return $pdf->stream('reporte');
    }
    public function generalsaleadvisor(Request $request){
        $negotiations = DB::table('negotiations as n')
            ->join('clients as c','n.client_id','=','c.id')
            ->select('n.id','n.user_id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion','n.updated_at')
            ->where('n.user_id', '=', Auth::user()->id)->where('n.estado', '=', 'ganada')->where('cedula', 'LIKE', '%'.$request->name.'%')->get();
         $view =  \View::make('advisor.sales.generalpdf', compact('negotiations'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('ventas.pdf');
//        return $pdf->stream('reporte');
    }
    public function salesadvisor($id){
        $negotiation = Negotiation::find($id);
//        dd($negotiations);
         $view =  \View::make('advisor.sales.pdf', compact('negotiation'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('comprobanteventa.pdf');
//        return $pdf->stream('reporte');
    }
    public function advisor(Request $request){
        $users=User::where('type', '=', 'advisor')->where('name', 'LIKE', '%'.$request->name.'%')->get();
        $view =  \View::make('salesmanager.advisors.pdf', compact('users'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->download('asesor.pdf');
//        return $pdf->stream('reporte');
    }
    public function ticketspendientes(Request $request){
        $ticketspendientes = Ticket::where('user_id', '=', Auth::user()->id)->where('estado', '=', 'pendiente')->orderBy('id','ASC')->get();
        $view =  \View::make('technical.tickets.pdf', compact('ticketspendientes'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->download('tickets_pendientes.pdf');
//        return $pdf->stream('reporte');
    }
    
} 
