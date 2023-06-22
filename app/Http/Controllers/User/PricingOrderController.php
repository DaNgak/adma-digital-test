<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PricingOrder;
use Illuminate\Http\Request;

class PricingOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $pricingOrders = PricingOrder::with(['location_start', 'location_finish'])->paginate(10);
    
        foreach ($pricingOrders as $pricingOrder) {
            $pricingOrder['estimated_time'] = ceil(intval($pricingOrder->distance) / 50) . " Jam";
            $pricingOrder['distance'] = $pricingOrder->distance . " KM" ;
            $pricingOrder['price'] = "Rp. " . number_format(intval($pricingOrder->price), 0, ',', '.');
        }
        
        return view('user.pricing-order.index', [
            'title' => 'Daftar Rute',
            'pricingOrders' => $pricingOrders,
        ]);
    }
}
