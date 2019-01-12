<?php

namespace App\Http\Controllers\Portal;

use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $details = OrderDetail::where('customer_id', '=', $request->user()->id)->whereHas('event', function ($query) {
            $query->where('end_date', '>', now());
        })->groupBy('event_id')->get();
        return view('portal.home', compact('details'));
    }
    public function History(Request $request)
    {
        $details = OrderDetail::where('customer_id', '=', $request->user()->id)->with(['event' => function ($query) {
            $query->where('start_date', '<', now())->where('end_date', '<', now());
        }
                                                                                      ])->groupBy('event_id')->get();
        return view('portal.customer.history', compact('details'));
    }
}
