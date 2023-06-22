@extends('layout.main.main')

@section('container')
    <h2 class="mb-3 fs-sm-3">Detail Kendaraan Sampah Detail</h2>
    <div class="col-xl-8 p-0 mb-3 mb-md-5">
        <a class="btn btn-primary me-0 me-3 w-100 w-lg-auto mb-3 mb-lg-0" href="{{ route('transport.trash.index') }}">Kembali ke Data Tabel</a>
        <form action="{{ route('transport.trash.restore', $transport->id) }}" class="d-inline w-100 w-lg-auto mb-3 mb-lg-0" method="post">
            @csrf
            @method("put")
            <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning w-100 me-3 w-lg-auto">Restore</button>
        </form>
        <form action="{{ route('transport.trash.destroy', $transport->id) }}" class="d-inline w-100 w-lg-auto mb-3 mb-lg-0" method="post">
            @csrf
            @method("delete")
            <button onclick="return confirm('Konfirmasi hapus data ?')" class="btn btn-danger w-100 w-lg-auto">Hapus Permanen</button>
        </form>
    </div>
    <div class="col-xl-8 mb-5 p-0">
        <div class="d-flex p-0 flex-sm-column">
            <div class="row mb-3 p-0">
                @if ($transport->image)
                    <div class="col-lg-8">
                        <img class="mx-sm-auto-custom" src="{{ asset("storage/" . $transport->image) }}" alt="Gambar" height="350px" style="display: block; aspect-ratio: 16/9; object-fit:cover; border:solid;"/>
                    </div>
                @else        
                    <div class="col-12">
                        <span class="form-control border-1 border-danger text-danger">Tidak ada Gambar untuk Kendaraan ini</span>
                    </div>
                @endif
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Nama</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transport->name }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Plat Nomer Kendaraan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transport->license_plate }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Merek Kendaraan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary {{ $transport->merek->name ?? "text-danger"}}">{{ $transport->merek->name ?? "Tidak ada tipe kendaraan"}}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Kapasitas Penumpang</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transport->size_passenger }} Orang</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                @if (count($transport->services) > 0)
                    <div class="col-lg-5">
                        <span class="form-control border-1 border-primary">Jumlah Servis Kendaraan</span>
                    </div>
                    <div class="col-lg-7">
                        <span class="form-control border-1 border-primary">{{ count($transport->services) }} Kali Servis</span>
                    </div>
                @else
                    <div class="col-12">
                        <span class="form-control border-1 border-danger text-danger">Tidak ada Riwayat Servis untuk Kendaraan Ini</span>
                    </div>
                @endif
            </div>
            <div class="row my-3 p-0">
                @if (count($transport->orders) > 0)
                    <div class="col-lg-5">
                        <span class="form-control border-1 border-primary">Jumlah Order Kendaraan</span>
                    </div>
                    <div class="col-lg-7">
                        <span class="form-control border-1 border-primary">{{ count($transport->orders) }} Kali Order</span>
                    </div>
                @else
                    <div class="col-12">
                        <span class="form-control border-1 border-danger text-danger">Tidak ada Riwayat Order untuk Kendaraan Ini</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection