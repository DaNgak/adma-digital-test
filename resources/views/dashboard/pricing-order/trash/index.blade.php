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
    {{-- Trash Index View --}}
    @if (!isset($search_key))
        @if ($pricingOrders->count() > 0)
            <div class="d-flex mb-3">
                <form action="{{ route('pricing-order-transport.trash.search') }}" method="post" class="d-inline-block navbar-search w-100">
                    @csrf
                    @method("post")
                    <div class="input-group">
                        <input id="key" type="text" name="key" value="{{ old("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama Kabupaten / Kota" />
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
                    <caption>Tabel Harga Order Sampah</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Lokasi 1</th>
                            <th scope="col">Lokasi 2</th>
                            <th scope="col">Jarak</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricingOrders as $pricingOrder) 
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pricingOrder->location_start->name }}</td>
                                <td>{{ $pricingOrder->location_finish->name }}</td>
                                <td>{{ $pricingOrder->distance }}</td>
                                <td>{{ $pricingOrder->price }}</td>
                                <td class="d-flex justify-content-center">
                                    <form action="{{ route('pricing-order-transport.trash.restore', $pricingOrder->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("put")
                                        <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning mr-2">Restore</button>
                                    </form>
                                    <form action="{{ route('pricing-order-transport.trash.destroy', $pricingOrder->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Konfirmasi hapus data secara permanen ?')" class="btn btn-danger">Hapus Permanen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $pricingOrders->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data Harga Order Sampah</h3>
            </div> 
        @endif
    @endif

    {{-- Trash Search View --}}
    @isset($search_key)
        <div class="d-flex mb-3">
            <form action="{{ route('pricing-order-transport.trash.search') }}" method="post" class="d-inline-block navbar-search w-100">
                @csrf
                @method("post")
                <div class="input-group">
                    <input id="key" type="text" name="key" value="{{ old("key", $search_key) }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama Kabupaten / Kota" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <em class="fas fa-search fa-sm"></em>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @if ($pricingOrders->count() > 0)
            <div class="table-responsive mb-5">
                <table class="table table-striped table-sm" >
                    <caption>Tabel Harga Order Sampah</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Lokasi 1</th>
                            <th scope="col">Lokasi 2</th>
                            <th scope="col">Jarak</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricingOrders as $pricingOrder)        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pricingOrder->location_start->name }}</td>
                                <td>{{ $pricingOrder->location_finish->name }}</td>
                                <td>{{ $pricingOrder->distance }}</td>
                                <td>{{ $pricingOrder->price }}</td>
                                <td class="d-flex justify-content-center">
                                    <form action="{{ route('pricing-order-transport.trash.restore', $pricingOrder->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("put")
                                        <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning mr-2">Restore</button>
                                    </form>
                                    <form action="{{ route('pricing-order-transport.trash.destroy', $pricingOrder->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Konfirmasi hapus data secara permanen ?')" class="btn btn-danger">Hapus Permanen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $pricingOrders->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data {{ $search_key }} pada Tabel Harga Order Sampah</h3>
            </div> 
        @endif
    @endisset
@endsection