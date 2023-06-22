@extends('layout.main.main')

@section('container')
    <h2 class="mb-3 fs-sm-3">Detail Transaksi</h2>
    <div class="col-xl-8 p-0 mb-3 mb-md-4">
        <a class="btn btn-primary me-0 me-lg-3 w-100 w-lg-auto mb-3 mb-lg-0" href="{{ route($transactions_route["index"]) }}">Kembali ke Data Tabel</a>
        <form action="{{ route($transactions_route["delete"], $transaction->id) }}" class="d-inline w-100 w-lg-auto mb-3 mb-lg-0" method="post">
            @csrf
            @method("delete")
            <button onclick="return confirm('Konfirmasi hapus data ?')" class="btn btn-danger w-100 w-lg-auto">Hapus</button>
        </form>
    </div>
    <div class="col-xl-8 mb-5 p-0">
        <div class="d-flex p-0 flex-sm-column">
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Penghuni Kos | Kamar</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transaction->dormitory->name }} | Kamar {{ $transaction->dormitory->rooms[0]->room_number }}</span>
                </div>
            </div>
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Total Bulan Bayar</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transaction->total_month }}</span>
                </div>
            </div>
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Dari Tanggal</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transaction->from }}</span>
                </div>
            </div>
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Sampai Tanggal</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transaction->to }}</span>
                </div>
            </div>
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Jenis Pembayaran</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $transaction->kindpayment->name }}</span>
                </div>
            </div>
            @if ($transaction->kindpayment->need_image)
                <div class="row mb-3 p-0 flex-column">
                    <div class="col-md-8 col-lg-5 mb-3">
                        <span class="form-control border-1 border-primary">Bukti Pembayaran</span>
                    </div>
                    <div class="col-md-8 col-lg-5">
                        <img class="mx-sm-auto-custom" src="{{ asset("storage/" . $transaction->proof_payment) }}" alt="Gambar" width="90%" style="display: block; aspect-ratio: 9/16; object-fit:cover; border:solid;"/>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection