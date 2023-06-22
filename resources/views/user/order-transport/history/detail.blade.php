@extends('layout.main.main')

@section('container')
    <h2 class="mb-3 fs-sm-3">Detail Order Kendaraan</h2>
    <div class="col-xl-8 p-0 mb-3 mb-md-5">
        <a class="btn btn-primary me-0 me-3 w-100 w-lg-auto mb-3 mb-lg-0" href="{{ route('user.order.history') }}">Kembali ke Data Tabel</a>
    </div>
    <div class="col-xl-8 mb-5 p-0">
        <div class="d-flex p-0 flex-sm-column">
            <div class="row mb-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Kode Pesanan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->code }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Status Pesanan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->status }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Nama / Plat Nomer Kendaraan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->transport->name }} / {{ $orderTransport->transport->license_plate }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Lokasi Start</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->location_start->name }} - {{ $orderTransport->location_start->province }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Lokasi Tujuan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->location_finish->name }} - {{ $orderTransport->location_finish->province }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Jumlah Penumpang</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->total_passanger }} Orang</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Lokasi Penjemputan</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->pickup_location }}</span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Estimasi Jarak / Waktu</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->pricing_order->distance }} / {{ $orderTransport->pricing_order->estimated_time }} </span>
                </div>
            </div>
            <div class="row my-3 p-0">
                <div class="col-lg-5">
                    <span class="form-control border-1 border-primary">Total Pembayaran</span>
                </div>
                <div class="col-lg-7">
                    <span class="form-control border-1 border-primary">{{ $orderTransport->pricing_order->price }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection