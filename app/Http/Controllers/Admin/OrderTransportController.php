<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTransport;
use Illuminate\Http\Request;

class OrderTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderTransport::with(['transport', 'client', 'pricing_order', 'location_start', 'location_finish'])->orderBy('date_pickup')->paginate(10);
        return view('dashboard.order-transport.index', [
            'title' => 'Data Order Kendaraan',
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderTransport $orderTransport)
    {
        $orderTransport->loadMissing(['transport', 'client', 'pricing_order', 'location_start', 'location_finish']);
        $orderTransport->pricing_order['distance'] = $orderTransport->pricing_order->distance . " KM" ;
        $orderTransport->pricing_order['price'] = "Rp. " . number_format(intval($orderTransport->pricing_order->price), 0, ',', '.');

        return view('dashboard.order-transport.detail', [
            'title' => 'Detail Order Kendaraan',
            'orderTransport' => $orderTransport
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderTransport $orderTransport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderTransport $orderTransport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderTransport $orderTransport)
    {
        $orderTransport->delete();
        return redirect()->route('order-transport.index')->with('success', 'Data Order Kendaraan berhasil dihapus');
    }

    public function search(Request $request)
    {
        $orders = OrderTransport::with(['transport', 'client', 'pricing_order', 'location_start', 'location_finish'])
            ->selectRaw('order_transports.*')
            ->join('transports as tr', 'order_transports.transport_id', '=', 'tr.id')
            ->join('users as us', 'order_transports.user_id', '=', 'us.id')
            ->join('pricing_orders as po', 'order_transports.pricing_order_id', '=', 'po.id')
            ->join('locations as ls_start', 'order_transports.location_start_id', '=', 'ls_start.id')
            ->join('locations as ls_finish', 'order_transports.location_finish_id', '=', 'ls_finish.id')
            ->where('tr.name', 'like', "%$request->key%")
            ->orWhere('tr.license_plate', 'like', "%$request->key%")
            ->orWhere('us.username', 'like', "%$request->key%")
            ->orWhere('us.phone', 'like', "%$request->key%")
            ->orWhere('po.price', 'like', "%$request->key%")
            ->orWhere('ls_start.name', 'like', "%$request->key%")
            ->orWhere('ls_finish.name', 'like', "%$request->key%")
            ->orWhere('date_pickup', 'like', "%$request->key%")
            ->orWhere('status', 'like', "%$request->key%")
            ->orderBy('date_pickup')->paginate(10);

        return view('dashboard.order-transport.index', [
            'title' => 'Data Order Kendaraan',
            'orders' => $orders,
            'search_key' => $request->key
        ]);
    }

    public function trashIndex()
    {
        $orders = OrderTransport::onlyTrashed()->with(['transport', 'client', 'pricing_order', 'location_start', 'location_finish'])->orderBy('date_pickup')->paginate(10);

        return view('dashboard.order-transport.trash.index', [
            'title' => 'Data Order Kendaraan Sampah',
            'orders' => $orders,
        ]);
    }


    public function trashSearch(Request $request)
    {
        $orders = OrderTransport::onlyTrashed()->with(['transport', 'client', 'pricing_order', 'location_start', 'location_finish'])
            ->selectRaw('order_transports.*')
            ->join('transports as tr', 'order_transports.transport_id', '=', 'tr.id')
            ->join('users as us', 'order_transports.user_id', '=', 'us.id')
            ->join('pricing_orders as po', 'order_transports.pricing_order_id', '=', 'po.id')
            ->join('locations as ls_start', 'order_transports.location_start_id', '=', 'ls_start.id')
            ->join('locations as ls_finish', 'order_transports.location_finish_id', '=', 'ls_finish.id')
            ->where('tr.name', 'like', "%$request->key%")
            ->orWhere('tr.license_plate', 'like', "%$request->key%")
            ->orWhere('us.username', 'like', "%$request->key%")
            ->orWhere('us.phone', 'like', "%$request->key%")
            ->orWhere('po.price', 'like', "%$request->key%")
            ->orWhere('ls_start.name', 'like', "%$request->key%")
            ->orWhere('ls_finish.name', 'like', "%$request->key%")
            ->orWhere('date_pickup', 'like', "%$request->key%")
            ->orWhere('status', 'like', "%$request->key%")
            ->orderBy('date_pickup')->paginate(10);

        return view('dashboard.order-transport.trash.index', [
            'title' => 'Data Order Kendaraan Sampah',
            'orders' => $orders,
            'search_key' => $request->key
        ]);
    }

    public function trashShow($id)
    {
        $orderTransport = OrderTransport::onlyTrashed()->findOrFail($id);
        $orderTransport->pricing_order['distance'] = $orderTransport->pricing_order->distance . " KM" ;
        $orderTransport->pricing_order['price'] = "Rp. " . number_format(intval($orderTransport->pricing_order->price), 0, ',', '.');

        return view('dashboard.order-transport.trash.detail', [
            'title' => 'Data Kendaraan Sampah Detail',
            'orderTransport' => $orderTransport,
        ]);
    }

    public function trashRestore($id)
    {
        $orderTransport = OrderTransport::onlyTrashed()->findOrFail($id);
        if($orderTransport->trashed()){
            $orderTransport->restore();
            return redirect()->route('order-transport.trash.index')->with('success', 'Data Order Kendaraan berhasil di restore. Lihat data <a href="' . route('order-transport.index') . '">disini</a>');
        }
        return redirect()->route('order-transport.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }

    public function trashDestroy($id){
        $orderTransport = OrderTransport::onlyTrashed()->findOrFail($id);
        if($orderTransport->trashed()){
            $orderTransport->forceDelete();
            return redirect()->route('order-transport.trash.index')->with('success', 'Data Order Kendaraan berhasil di hapus secara permanen');
        } 

        return redirect()->route('order-transport.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }
}
