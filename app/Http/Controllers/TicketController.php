<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ticket;
use JWTAuth;

class TicketController extends Controller
{
    public function ticket()
    {
        # code...
        return $this->hasMany('App\User');
    }
    //
    public function index(Request $request,$id_user)
    {
        # code...
        // $header=$request->header('Authorization');
        $payload=JWTAuth::getToken();
        $t=ticket::where('id_user',$id_user)->get();
        // return $payload;
        return ['tickets'=>$t];
        // $t=ticket::select('tickets.id','users.name','tickets.ticket_pedido')->join('users','users.id','=','tickets.id_user')->get();
    }

    public function tickets()
    {
        # code...
        $t=ticket::select('tickets.id','users.name','tickets.ticket_pedido')->join('users','users.id','=','tickets.id_user')->get();
        return $t;
    }

    public function getticket($id)
    {
        # code...
        // $t=ticket::where('id',$id)->get();
        $t=ticket::select('tickets.id','users.name','tickets.id_user','tickets.ticket_pedido')->join('users','users.id','=','tickets.id_user')->where('tickets.id',$id)->get();
        return $t;
    }

    public function store(Request $request)
    {
        # code...
        $t=new ticket();
        $t->id_user=$request->id_user;
        $t->ticket_pedido=$request->ticket_pedido;

        $t->save();
        return response()->json(['status' => 'Ticket Creado']);
    }

    // Actualizar un ticket
    public function update($id, Request $request)
    {
        # code...
        $t= ticket::findOrFail($id);
        $t->id_user=$request->id_user;
        $t->ticket_pedido=$request->ticket_pedido;

        $t->save();

        return $t;
    }

    public function destroy($id)
    {
        # code...
        $t= ticket::destroy($id);
        return $t;
    }
}
