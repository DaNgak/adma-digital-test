@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('dashboard.index') }}">Kermbali ke Dashboard</a>
    </div>
    {{-- Index View --}}
    @if ($pricingOrders->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm" >
                <caption>Tabel Daftar Rute & Harga</caption>
                <thead>
                    <tr>
                        <th scope="col">Nomer</th>
                        <th scope="col">Lokasi Asal</th>
                        <th scope="col">Lokasi Tujuan</th>
                        <th scope="col">Estimasi Jarak</th>
                        <th scope="col">Estimasi Waktu Tempuh</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pricingOrders as $pricingOrder) 
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pricingOrder->location_start->name }}</td>
                            <td>{{ $pricingOrder->location_finish->name }}</td>
                            <td>{{ $pricingOrder->distance }}</td>
                            <td>{{ $pricingOrder->estimated_time }}</td>
                            <td>{{ $pricingOrder->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-info">
            <p>Note : Lokasi Asal dan Tujuan berlaku untuk kebalikannya</p>
        </div>
        <div>
            {{ $pricingOrders->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>Tidak ada Daftar Rute</h3>
        </div> 
    @endif
@endsection