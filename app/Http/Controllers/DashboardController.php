<?php

namespace App\Http\Controllers;

use App\Models\OrderTransport;
use App\Models\PricingOrder;
use App\Models\Transport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentDate = Carbon::now()->startOfDay();
        $orderTransports = OrderTransport::where('user_id', auth()->user()->id)->where('status', 'ongoing')->get();
        foreach ($orderTransports as $orderTransport) {
            if ($orderTransport->date_pickup <= $currentDate) {
                $orderTransport->status = "finish";
                $orderTransport->save();
            }
        }

        if (Auth::user()->role === "admin") {
            return view("dashboard.index", [
                "title" => "Dashboard Admin",
                'total_transports' => Transport::count(),
                'total_orders' => OrderTransport::count(),
                'total_users' => User::where('role', 'user')->count(),
                'total_admins' => User::where('role', 'admin')->count(),
            ]);
        }
        
        return view("dashboard.index", [
            "title" => "Dashboard User",
            'total_transports' => Transport::count(),
            'total_pricing_orders' => PricingOrder::count(),
            'total_orders' => OrderTransport::where('user_id', auth()->user()->id)->where('status', 'ongoing')->count(),
            'total_orders_done' => OrderTransport::where('user_id', auth()->user()->id)->where('status', 'finish')->count(),
        ]);
    }
}
