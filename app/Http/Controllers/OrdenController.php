<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
{
    public function show(Request $request){
        if (Auth::guard('attendee')->check()){
            $data = $request->all();
            $arr_ticket_id = [];
            $data_ticket = [];
            $ticket_id = "";
            if ($arr_json = json_decode($request->buy_json,1)){
                foreach($arr_json as $li){
                    $data_ticket[$li['id']]['cant'] = $li['cant'];
                    array_push($arr_ticket_id,$li['id']);
                }
                $tickets = Ticket::WhereIn('id',$arr_ticket_id)->get();
                return view('portal.orden.create',compact('tickets','data_ticket','data'));
            }
            return redirect(route('event.page',[$request->key_app,$request->page_id]));
        }else{
            return redirect(route('portal.login'));
        }
    }
}
