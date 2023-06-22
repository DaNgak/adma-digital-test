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
        @if ($transports->count() > 0)
            <div class="d-flex mb-3">
                <form action="{{ route('transport.trash.search') }}" method="post" class="d-inline-block navbar-search w-100">
                    @csrf
                    @method("post")
                    <div class="input-group">
                        <input id="key" type="text" name="key" value="{{ old("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama Kendaraan / Plat Nomer" />
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
                    <caption>Tabel Kendaraan</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Plat Nomer</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transports as $transport)        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transport->name }}</td>
                                <td>{{ $transport->license_plate }}</td>
                                <td>{{ $transport->size_passenger }} Orang</td>
                                <td>{!! $transport->merek->name ?? '<b class="text-danger">-</b>' !!}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('transport.trash.show', $transport->id) }}" class="btn btn-primary mr-2">Detail</a>
                                    <form action="{{ route('transport.trash.restore', $transport->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("put")
                                        <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning mr-2">Restore</button>
                                    </form>
                                    <form action="{{ route('transport.trash.destroy', $transport->id) }}" class="d-inline" method="post">
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
                {{ $transports->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data Kendaraan Sampah</h3>
            </div> 
        @endif
    @endif

    {{-- Search View --}}
    @isset ($search_key)
        <div class="d-flex mb-3">
            <form action="{{ route('transport.trash.search') }}" method="post" class="d-inline-block navbar-search w-100">
                @csrf
                @method("post")
                <div class="input-group">
                    <input id="key" type="text" name="key" value="{{ old("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Nama Kendaraan / Plat Nomer" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <em class="fas fa-search fa-sm"></em>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @if ($transports->count() > 0)
            <div class="table-responsive mb-5">
                <table class="table table-striped table-sm" >
                    <caption>Tabel Kendaraan</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Plat Nomer</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transports as $transport)        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transport->name }}</td>
                                <td>{{ $transport->license_plate }}</td>
                                <td>{{ $transport->size_passenger }} Orang</td>
                                <td>{!! $transport->merek->name ?? '<b class="text-danger">-</b>' !!}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('transport.trash.show', $transport->id) }}" class="btn btn-primary mr-2">Detail</a>
                                    <form action="{{ route('transport.trash.restore', $transport->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("put")
                                        <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning mr-2">Restore</button>
                                    </form>
                                    <form action="{{ route('transport.trash.destroy', $transport->id) }}" class="d-inline" method="post">
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
                {{ $transports->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data {{ $search_key }} pada Tabel Kendaraan Sampah</h3>
            </div> 
        @endif
    @endisset
@endsection