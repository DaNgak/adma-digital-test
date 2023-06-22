@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('dashboard.index') }}">Kembali ke Dashboard</a>
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('order.create') }}">Buat Pesanan</a>
    </div>
    {{-- Index View --}}
    @if ($orders->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm" >
                <caption>Tabel Riwayat Order</caption>
                <thead>
                    <tr>
                        <th scope="col">Nama / Plat Nomer</th>
                        <th scope="col">Lokasi Start - Lokasi Tujuan</th>
                        <th scope="col">Jumlah Penumpang</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Tanggal Pickup</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)       
                        <tr class="text-center">
                            <td>{{ $order->transport->name }} ({{ $order->transport->license_plate }})</td>
                            <td>{{ $order->location_start->name }} - {{ $order->location_finish->name }}</td>
                            <td>{{ $order->total_passanger }} Orang</td>
                            <td>Rp. {{ number_format(intval($order->pricing_order->price), 0, ',', '.') }}</td>
                            <td>{{ $order->date_pickup }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary mr-2">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $orders->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>Tidak ada Data Riwayat Order</h3>
        </div> 
    @endif
@endsection