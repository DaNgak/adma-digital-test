<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merek;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transport.index', [
            'title' => 'Data Kendaraan',
            'transports' => Transport::with(['merek', 'services'])->orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transport.create', [
            'title' => 'Tambah Kendaraan',
            'mereks' => Merek::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulesData = [
            'name' => 'required|unique:transports',
            'license_plate' => 'required|unique:transports',
            'size_passenger' => 'required|integer|min:1|max:30',
            'merek_id' => 'required'
        ];

        if ($request->file('image')) {
            $rulesData['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validatedData = $request->validate($rulesData);
        
        if ($request->file('image')) {
            $file = $request->file('image')->store('transport-images', 'public');
            $validatedData['image'] = $file;
        }

        Transport::create($validatedData);
        return redirect()->route('transport.index')->with('success', 'Data Kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        return view('dashboard.transport.detail', [
            'title' => 'Detail Kendaraan',
            'transport' => $transport->loadMissing(['merek', 'orders', 'services'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('dashboard.transport.edit', [
            'title' => 'Edit Kendaraan',
            'transport' => $transport->loadMissing(['merek']),
            'mereks' => Merek::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        $rulesData = [
            'name' => 'required|unique:transports,name,' . $transport->id,
            'license_plate' => 'required|unique:transports,license_plate,' . $transport->id,
            'size_passenger' => 'required|integer|min:1|max:30',
            'merek_id' => 'required'
        ];

        if ($request->file('image')) {
            $rulesData['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validatedData = $request->validate($rulesData);
        
        if ($request->file('image')) {
            if ($transport->image) {
                Storage::disk('public')->delete('storage/' . $transport->image);
            }
            $file = $request->file('image')->store('transport-images', 'public');
            $validatedData['image'] = $file;
        }

        $transport->update($validatedData);
        return redirect()->route('transport.index')->with('success', 'Data Kendaraan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();
        return redirect()->route('transport.index')->with('success', 'Data Kendaraan berhasil dihapus');
    }

    public function search(Request $request)
    {
        $transports = Transport::with(['merek'])->where('name', 'like', "%$request->key%")->orWhere('license_plate', 'like', "%$request->key%")->orderBy('name')->paginate(10);
        return view('dashboard.transport.index', [
            'title' => 'Data Kendaraan',
            'transports' => $transports,
            'search_key' => $request->key
        ]);
    }

    public function trashIndex()
    {
        $transports = Transport::onlyTrashed()->with(['merek'])->orderBy('name')->paginate(10);
        return view('dashboard.transport.trash.index', [
            'title' => 'Data Kendaraan Sampah',
            'transports' => $transports,
        ]);
    }

    public function trashSearch(Request $request)
    {
        $transports = Transport::onlyTrashed()->with(['merek'])->where('name', 'like', "%$request->key%")->orWhere('license_plate', 'like', "%$request->key%")->orderBy('name')->paginate(10);
        return view('dashboard.transport.trash.index', [
            'title' => 'Data Kendaraan Sampah',
            'transports' => $transports,
            'search_key' => $request->key
        ]);
    }

    public function trashShow($id)
    {
        $transport = Transport::onlyTrashed()->findOrFail($id);
        return view('dashboard.transport.trash.detail', [
            'title' => 'Data Kendaraan Sampah Detail',
            'transport' => $transport,
        ]);
    }

    public function trashRestore($id)
    {
        $transport = Transport::onlyTrashed()->findOrFail($id);
        if($transport->trashed()){
            $transport->restore();
            return redirect()->route('transport.trash.index')->with('success', 'Data Kendaraan berhasil di restore. Lihat data <a href="' . route('transport.index') . '">disini</a>');
        }
        return redirect()->route('transport.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }

    public function trashDestroy($id){
        $transport = Transport::onlyTrashed()->findOrFail($id);
        if($transport->trashed()){
            $transport->forceDelete();
            return redirect()->route('transport.trash.index')->with('success', 'Data Kendaraan berhasil di hapus secara permanen');
        } 

        return redirect()->route('transport.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }
}
