@extends('layout.main.main')

@section('container')
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session("success") !!}
                <button type="button" class="btn-close py-0 py-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    {{-- Index View --}}
    @if (!isset($search_key))
        @if ($orders->count() > 0)
            <div class="d-flex mb-3">
                <form action="{{ route('order-transport.trash.search') }}" class="d-inline-block navbar-search w-100">
                    <div class="input-group">
                        <input id="key" type="text" name="key" value="{{ old("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama / Nomer Kendaran, Lokasi, Harga, Username / No Telp, Status" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <em class="fas fa-search fa-sm"></em>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive mb-5">
                <table class="table table-striped table-sm" >
                    <caption>Tabel Order Kendaraan Sampah</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nama / Plat Nomer</th>
                            <th scope="col">Lokasi Start - Lokasi Tujuan</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga / Jarak Tempuh</th>
                            <th scope="col">Tanggal Pickup</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)        
                            <tr>
                                <td>{{ $order->transport->name }} ({{ $order->transport->license_plate }})</td>
                                <td>{{ $order->location_start->name }} - {{ $order->location_finish->name }}</td>
                                <td>{{ $order->client->username }} ({{ $order->client->phone }})</td>
                                <td>{{ $order->status }}</td>
                                <td>Rp. {{ number_format(intval($order->pricing_order->price), 0, ',', '.') }} / {{ $order->pricing_order->distance }} KM</td>
                                <td>{{ $order->date_pickup }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('order-transport.trash.show', $order->id) }}" class="btn btn-primary mr-2">Detail</a>
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
                <h3>Tidak ada Data Order Kendaraan Sampah</h3>
            </div> 
        @endif
    @endif

    {{-- Search View --}}
    @isset ($search_key)
        <div class="d-flex mb-3">
            <form action="{{ route('order-transport.trash.search') }}" method="post" class="d-inline-block navbar-search w-100">
                <div class="input-group">
                    <input id="key" type="text" name="key" value="{{ old("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama / Nomer Kendaran, Lokasi, Harga, Username / No Telp, Status" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <em class="fas fa-search fa-sm"></em>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @if ($orders->count() > 0)
            <div class="table-responsive mb-5">
                <table class="table table-striped table-sm" >
                    <caption>Tabel Order Kendaraan Sampah</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nama / Plat Nomer</th>
                            <th scope="col">Lokasi Start - Lokasi Tujuan</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga / Jarak Tempuh</th>
                            <th scope="col">Tanggal Pickup</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)        
                            <tr>
                                <td>{{ $order->transport->name }} ({{ $order->transport->license_plate }})</td>
                                <td>{{ $order->location_start->name }} - {{ $order->location_finish->name }}</td>
                                <td>{{ $order->client->username }} ({{ $order->client->phone }})</td>
                                <td>{{ $order->status }}</td>
                                <td>Rp. {{ number_format(intval($order->pricing_order->price), 0, ',', '.') }} / {{ $order->pricing_order->distance }} KM</td>
                                <td>{{ $order->date_pickup }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('order-transport.trash.show', $order->id) }}" class="btn btn-primary mr-2">Detail</a>
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
                <h3>Tidak ada Data {{ $search_key }} pada Tabel Order Kendaraan Sampah</h3>
            </div> 
        @endif
    @endisset
@endsection