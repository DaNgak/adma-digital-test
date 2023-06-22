<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\OrderTransport;
use App\Models\PricingOrder;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class OrderTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderTransport::with(['transport', 'pricing_order', 'location_start', 'location_finish'])->where('user_id', auth()->user()->id)->where('status', 'ongoing')->orderBy('date_pickup')->paginate(10);

        foreach ($orders as $order) {
            $order['date_pickup'] = Carbon::createFromFormat('Y-m-d', $order->date_pickup)->format('d F Y');
        }

        return view('user.order-transport.index', [
            'title' => 'Data Order User',
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.order-transport.create', [
            'title' => 'Data Order User',
            'transports' => Transport::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulesData = [
            'transport_id' => 'required|numeric',
            'location_start_id' => 'required|numeric',
            'location_finish_id' => 'required|numeric',
            'total_passanger' => 'required|integer|min:1|max:10',
            'pickup_location' => 'required|string|max:255',
            'date_pickup' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rulesData);

        $transport = Transport::where('id', $request->transport_id)->get()->first();
        // return dd($transport);

        // Validasi total penumpang
        if ($request->total_passanger > $transport->size_passenger) {
            $validator->errors()->add(
                'total_passanger',
                "The maximum size passanger in this transport not be greater than " . $transport->size_passenger
            );
            return redirect(route('order.create'))->withErrors($validator)->withInput();
        }

        // Validasi lokasi
        if ($request->location_start_id == $request->location_finish_id) {
            $validator->errors()->add(
                'location_start_id',
                "Location start and location finish can't be the same."
            );
            return redirect(route('order.create'))->withErrors($validator)->withInput();
        }

        // Validasi Tanggal
        $requestedDate = Carbon::parse($request->date_pickup)->startOfDay();
        $currentDate = Carbon::now()->startOfDay();
        $previousDates = Carbon::now()->subDays(2)->startOfDay();
        
        if ($requestedDate <= $previousDates || $requestedDate == $currentDate) {
            $validator->errors()->add(
                'date_pickup',
                "The pickup date must be at least tomorrow. Cannot be today or a date before today"
            );
            return redirect(route('order.create'))->withErrors($validator)->withInput();
        }

        // Pricing Order
        $pricing = PricingOrder::where('location_start_id', $request->location_start_id)
            ->where('location_finish_id', $request->location_finish_id)
            ->get()->first();

        if ($pricing === null) {
            $pricing = PricingOrder::where('location_start_id', $request->location_finish_id)
            ->where('location_finish_id', $request->location_start_id)
            ->get()->first();
        }

        $location1 = Location::where('id', $request->location_start_id)->get()->first();
        $location2 = Location::where('id', $request->location_finish_id)->get()->first();

        if ($pricing === null) {
            $validator->errors()->add(
                'location_start_id',
                "Route from Location " . $location1 . " to Location " . $location2 . " is not available."
            );
            return redirect(route('order.create'))->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['pricing_order_id'] = $pricing->id;
        $validatedData['user_id'] = auth()->user()->id;

        // return dd($validatedData);

        OrderTransport::create($validatedData);
        return redirect()->route('order.index')->with('success', 'Data Order berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderTransport = OrderTransport::findOrFail($id);
        
        if ($orderTransport->user_id !== auth()->user()->id) {
            return abort(403);
        }
        
        $orderTransport->loadMissing(['transport', 'pricing_order', 'location_start', 'location_finish']);
        $orderTransport['code'] = "TA-" . substr(Hash::make($orderTransport->id), 0, 10);
        $orderTransport['date_pickup'] = Carbon::createFromFormat('Y-m-d', '2023-06-06')->format('d F Y');
        $orderTransport->pricing_order['estimated_time'] = ceil(intval($orderTransport->pricing_order->distance) / 50) . " Jam";
        $orderTransport->pricing_order['distance'] = $orderTransport->pricing_order->distance . " KM" ;
        $orderTransport->pricing_order['price'] = "Rp. " . number_format(intval($orderTransport->pricing_order->price), 0, ',', '.');

        return view('user.order-transport.detail', [
            'title' => 'Detail Order User',
            'orderTransport' => $orderTransport
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }

    public function cancelOrder(string $id)
    {
        $orderTransport = OrderTransport::findOrFail($id);

        if ($orderTransport->user_id !== auth()->user()->id) {
            return abort(403);
        }

        $orderTransport->status = "cancel";
        $orderTransport->save();

        return redirect()->route('order.show', $orderTransport->id)->with('success', 'Data Order Pesanan berhasil dibatalkan');
    }

    public function history() {
        $orders = OrderTransport::with(['transport', 'pricing_order', 'location_start', 'location_finish'])->where('user_id', auth()->user()->id)->where('status', 'finish')->orderBy('date_pickup')->paginate(10);

        foreach ($orders as $order) {
            $order['date_pickup'] = Carbon::createFromFormat('Y-m-d', $order->date_pickup)->format('d F Y');
        }

        return view('user.order-transport.history.index', [
            'title' => 'Data History Order User',
            'orders' => $orders,
        ]);
    }

    public function historyDetail(string $id) {
        $orderTransport = OrderTransport::findOrFail($id);
        
        if ($orderTransport->user_id !== auth()->user()->id) {
            return abort(403);
        }
        
        $orderTransport->loadMissing(['transport', 'pricing_order', 'location_start', 'location_finish']);
        $orderTransport['code'] = "TA-" . substr(Hash::make($orderTransport->id), 0, 10);
        $orderTransport['date_pickup'] = Carbon::createFromFormat('Y-m-d', '2023-06-06')->format('d F Y');
        $orderTransport->pricing_order['estimated_time'] = ceil(intval($orderTransport->pricing_order->distance) / 50) . " Jam";
        $orderTransport->pricing_order['distance'] = $orderTransport->pricing_order->distance . " KM" ;
        $orderTransport->pricing_order['price'] = "Rp. " . number_format(intval($orderTransport->pricing_order->price), 0, ',', '.');

        return view('user.order-transport.history.detail', [
            'title' => 'Detail History Order User',
            'orderTransport' => $orderTransport
        ]);
    }

    public function historySearch(Request $request)
    {
        $orders = OrderTransport::with(['transport', 'pricing_order', 'location_start', 'location_finish'])
            ->selectRaw('order_transports.*')
            ->join('transports as tr', 'order_transports.transport_id', '=', 'tr.id')
            ->join('pricing_orders as po', 'order_transports.pricing_order_id', '=', 'po.id')
            ->join('locations as ls_start', 'order_transports.location_start_id', '=', 'ls_start.id')
            ->join('locations as ls_finish', 'order_transports.location_finish_id', '=', 'ls_finish.id')
            ->where('tr.name', 'like', "%$request->key%")
            ->orWhere('tr.license_plate', 'like', "%$request->key%")
            ->orWhere('po.price', 'like', "%$request->key%")
            ->orWhere('ls_start.name', 'like', "%$request->key%")
            ->orWhere('ls_finish.name', 'like', "%$request->key%")
            ->orWhere('date_pickup', 'like', "%$request->key%")
            ->orderBy('date_pickup')->paginate(10);

        return view('user.order-transport.history.index', [
            'title' => 'Data History Order User',
            'orders' => $orders,
            'search_key' => $request->key
        ]);
    }
}
