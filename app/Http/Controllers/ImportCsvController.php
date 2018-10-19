<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Event;
use App\Notifications\CreateCustomer;
use App\Order;
use App\OrderDetail;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImportCsvController extends Controller
{
    public function importCsv(Request $request, Event $event)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $request->validate([
            'ticket_id' => 'exists:tickets,id',
            'csv' => 'required',
        ]);
        Ticket::checkIncompleteTickets();
        $ticket = Ticket::find($request->ticket_id);
        $file = $request->file('csv');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            $row = array_combine($header, $row);
            $customer = Customer::where('email',$row['email'])->first();
            if (!$customer){
                $customer = Customer::create([
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "email" => $row['email'],
                    "document" => $row['document_number'],
                    "phone" => $row['contact_number'],
                    "workplace" => $row['workplace'],
                    "profession" => $row['profession'],
                    "password" => bcrypt('evento2018'),
                    "created_at" => now()
                ]);
                $customer->notify(new CreateCustomer($customer,$row['email'],'evento2018'));
            }
            $order = new Order();
            $order->event_id        = $event->id;
            $order->customer_id     = $customer->id;
            $order->order_status_id = 1;
            $order->reference       = Str::uuid();
            $order->save();
            OrderDetail::addDetail($ticket,$order,['complete' => 1,'customer_id' => $customer->id]);
            $ticket->decrement('quantity_available',1);
            $ticket->save();
            if ($ticket->quantity_available == 0){
                session()->flash('message','No hay tiquetes disponibles');
                return back();
            }
        }
        session()->flash('message','Archivo importado');
        return back();
    }
}
