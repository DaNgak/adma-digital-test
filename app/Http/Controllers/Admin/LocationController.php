<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.location.index', [
            'title' => 'Data Lokasi',
            'locations' => Location::orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.location.create', [
            'title' => 'Tambah Lokasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulesData = [
            'name' => 'required|unique:locations',
            'province' => 'required',
        ];

        $validatedData = $request->validate($rulesData);
        Location::create($validatedData);
        return redirect()->route('location.index')->with('success', 'Data Lokasi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('dashboard.location.edit', [
            'title' => 'Edit Lokasi',
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $rulesData = [
            'name' => 'required|unique:locations,name,' . $location->id,
            'province' => 'required',
        ];

        $validatedData = $request->validate($rulesData);
        $location->update($validatedData);
        return redirect()->route('location.index')->with('success', 'Data Lokasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('location.index')->with('success', 'Data Lokasi berhasil dihapus');
    }

    public function search(Request $request)
    {
        var_dump($request->key);
        $locations = Location::where('name', 'like', "%$request->key%")->paginate(10);
        return view('dashboard.location.index', [
            'title' => 'Table Lokasi',
            'locations' => $locations,
            'search_key' => $request->key
        ]);
    }

    public function trashIndex()
    {
        return view('dashboard.location.trash.index', [
            'title' => 'Data Lokasi Sampah',
            'locations' => Location::onlyTrashed()->paginate(10),
        ]);
    }

    public function trashSearch(Request $request)
    {
        return view('dashboard.location.trash.index', [
            'title' => 'Data Lokasi Sampah',
            'locations' => Location::onlyTrashed()->where('name', 'like', "%$request->key%")->paginate(10),
            'search_key' => $request->key
        ]);
    }

    public function trashRestore($id)
    {
        $location = Location::withTrashed()->findOrFail($id);
        if($location->trashed()){
            $location->restore();
            return redirect()->route('location.trash.index')->with('success', 'Data Lokasi berhasil di restore. Lihat data <a href="' . route('location.index') . '">disini</a>');
        } 

        return redirect()->route('location.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }

    public function trashDestroy($id){
        $location = Location::withTrashed()->findOrFail($id);
        if($location->trashed()){
            $location->forceDelete();
            return redirect()->route('location.trash.index')->with('success', 'Data Lokasi berhasil di hapus secara permanen');
        } 

        return redirect()->route('location.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }
}
