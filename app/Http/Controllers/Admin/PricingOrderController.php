<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\PricingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingOrders = PricingOrder::selectRaw('pricing_orders.*, ls.name as location_start_name')
            ->join('locations as ls', 'pricing_orders.location_start_id', '=', 'ls.id')
            ->orderBy('ls.name')
            ->paginate(10);
        
        foreach ($pricingOrders as $pricingOrder) {
            $pricingOrder['distance'] = $pricingOrder->distance . " KM" ;
            $pricingOrder['price'] = "Rp. " . number_format(intval($pricingOrder->price), 0, ',', '.');
        }
        
        return view('dashboard.pricing-order.index', [
            'title' => 'Data Harga Order',
            'pricingOrders' => $pricingOrders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pricing-order.create', [
            'title' => 'Tambah Harga Order',
            'location_starts' => Location::orderBy('name')->get(),
            'location_finishs' => Location::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulesData = [
            'location_start_id' => 'required',
            'location_finish_id' => 'required',
            'distance' => 'required|integer|min:1|max:1000',
            'price' => 'required|integer|min_digits:4|min:1000',
        ];

        $validator = Validator::make($request->all(), $rulesData);

        if ($request->location_start_id == $request->location_finish_id) {
            $validator->errors()->add(
                'location_start_id',
                "Location 1 and location 2 can't be the same."
            );
            return redirect(route('pricing-order.create'))->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        PricingOrder::create($validatedData);
        return redirect()->route('pricing-order.index')->with('success', 'Data Harga Order berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PricingOrder $pricingOrder)
    {
        return view('dashboard.pricing-order.edit', [
            'title' => 'Edit Harga Order',
            'pricingOrder' => $pricingOrder->loadMissing(['location_start', 'location_finish']),
            'location_starts' => Location::orderBy('name')->get(),
            'location_finishs' => Location::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PricingOrder $pricingOrder)
    {
        $rulesData = [
            'location_start_id' => 'required',
            'location_finish_id' => 'required',
            'distance' => 'required|integer|min:0|max:1000',
            'price' => 'required|integer|min_digits:4|min:1000',
        ];

        $validator = Validator::make($request->all(), $rulesData);

        if ($request->location_start_id == $request->location_finish_id) {
            $validator->errors()->add(
                'location_start_id',
                "Location 1 and location 2 can't be the same."
            );
            return redirect(route('pricing-order.edit'))->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $pricingOrder->update($validatedData);
        return redirect()->route('pricing-order.index')->with('success', 'Data Harga Order berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricingOrder $pricingOrder)
    {
        $pricingOrder->delete();
        return redirect()->route('pricing-order.index')->with('success', 'Data Harga Order berhasil dihapus');
    }

    public function search(Request $request)
    {
        $pricingOrders = PricingOrder::with(['location_start', 'location_finish'])
            ->whereHas('location_start', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->key}%");
            })
            ->orWhereHas('location_finish', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->key}%");
            })
            ->paginate(10);

        foreach ($pricingOrders as $pricingOrder) {
            $pricingOrder['distance'] = $pricingOrder->distance . " KM" ;
            $pricingOrder['price'] = "Rp. " . number_format(intval($pricingOrder->price), 0, ',', '.');
        }

        return view('dashboard.pricing-order.index', [
            'title' => 'Data Harga Order',
            'pricingOrders' => $pricingOrders,
            'search_key' => $request->key
        ]);
    }

    public function trashIndex()
    {
        $pricingOrders = PricingOrder::onlyTrashed()->selectRaw('pricing_orders.*, ls.name as location_start_name')
            ->join('locations as ls', 'pricing_orders.location_start_id', '=', 'ls.id')
            ->orderBy('ls.name')
            ->paginate(10);
        
        foreach ($pricingOrders as $pricingOrder) {
            $pricingOrder['distance'] = $pricingOrder->distance . " KM" ;
            $pricingOrder['price'] = "Rp. " . number_format(intval($pricingOrder->price), 0, ',', '.');
        }
        return view('dashboard.pricing-order.trash.index', [
            'title' => 'Data Harga Order Sampah',
            'pricingOrders' => $pricingOrders,
        ]);
    }

    public function trashSearch(Request $request)
    {
        $pricingOrders = PricingOrder::onlyTrashed()
            ->with(['location_start', 'location_finish'])
            ->whereHas('location_start', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->key}%");
            })
            ->orWhereHas('location_finish', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->key}%");
            })
            ->paginate(10);

        foreach ($pricingOrders as $index => $pricingOrder) {
            if ($pricingOrder->deleted_at == null) {
                unset($pricingOrders[$index]);
            }
            $pricingOrder['distance'] = $pricingOrder->distance . " KM" ;
            $pricingOrder['price'] = "Rp. " . number_format(intval($pricingOrder->price), 0, ',', '.');
        }
        return view('dashboard.pricing-order.trash.index', [
            'title' => 'Data Harga Order Sampah',
            'pricingOrders' => $pricingOrders,
            'search_key' => $request->key
        ]);
    }

    public function trashRestore($id)
    {
        $pricingOrder = PricingOrder::withTrashed()->findOrFail($id);
        if($pricingOrder->trashed()){
            $pricingOrder->restore();
            return redirect()->route('pricing-order.trash.index')->with('success', 'Data Harga Order berhasil di restore. Lihat data <a href="' . route('pricing-order.index') . '">disini</a>');
        } 

        return redirect()->route('pricing-order.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }

    public function trashDestroy($id){
        $location = PricingOrder::withTrashed()->findOrFail($id);
        if($location->trashed()){
            $location->forceDelete();
            return redirect()->route('pricing-order.trash.index')->with('success', 'Data Harga Order berhasil di hapus secara permanen');
        } 

        return redirect()->route('pricing-order.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }
}
