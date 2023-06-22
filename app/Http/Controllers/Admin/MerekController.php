<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merek;
use Illuminate\Http\Request;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.merek.index', [
            'title' => 'Data Merek Kendaraan',
            'mereks' => Merek::orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.merek.create', [
            'title' => 'Tambah Merek Kendaraan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulesData = [
            'name' => 'required|unique:mereks',
        ];

        $validatedData = $request->validate($rulesData);
        Merek::create($validatedData);
        return redirect()->route('merek.index')->with('success', 'Data Merek berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merek $merek)
    {
        return view('dashboard.merek.edit', [
            'title' => 'Edit Merek Kendaraan',
            'merek' => $merek,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merek $merek)
    {
        $rulesData = [
            'name' => 'required|unique:mereks,name,' . $merek->id,
        ];

        $validatedData = $request->validate($rulesData);
        $merek->update($validatedData);
        return redirect()->route('merek.index')->with('success', 'Data Merek Kendaraan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merek $merek)
    {
        $merek->delete();
        return redirect()->route('merek.index')->with('success', 'Data Merek Kendaraan berhasil dihapus');
    }

    public function trashIndex()
    {
        return view('dashboard.merek.trash.index', [
            'title' => 'Data Merek Sampah',
            'mereks' => Merek::onlyTrashed()->paginate(10),
        ]);
    }

    public function trashRestore($id)
    {
        $merek = Merek::withTrashed()->findOrFail($id);
        if($merek->trashed()){
            $merek->restore();
            return redirect()->route('merek.trash.index')->with('success', 'Data Merek Kendaraan berhasil di restore. Lihat data <a href="' . route('merek.index') . '">disini</a>');
        } 

        return redirect()->route('merek.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }

    public function trashDestroy($id){
        $merek = Merek::withTrashed()->findOrFail($id);
        if($merek->trashed()){
            $merek->forceDelete();
            return redirect()->route('merek.trash.index')->with('success', 'Data Merek Kendaraan berhasil di hapus secara permanen');
        } 

        return redirect()->route('merek.trash.index')->with('success', 'Data tidak ada di tabel sampah');
    }
}
