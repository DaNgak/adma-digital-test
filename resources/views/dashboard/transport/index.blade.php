@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('transport.create') }}">Tambah Data Transport</a>
        @if ($transports->count() > 0)
            {{-- <form action="" class="d-inline" method="post">
                @csrf
                @method("post")
                <button class="btn btn-success border-0">Generete Report</button>
            </form> --}}
            <div class="d-flex flex-column flex-md-row col-12 col-md-auto p-0">
                {{-- <a class="btn btn-success mr-0 mr-md-2 col-12 col-md-auto mb-3 mb-md-0" href="{{ "#" }}">Excel (csv)</a> --}}
                <a class="btn btn-success col-12 col-md-auto" href="{{ "#" }}">Excel (xlsx)</a>
            </div>
        @endif
    </div>
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close py-0 py-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    {{-- Index View --}}
    @if (!isset($search_key))
        @if ($transports->count() > 0)
            <div class="d-flex mb-3">
                <form action="{{ route('transport.search') }}" method="post" class="d-inline-block navbar-search w-100">
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
                                    <a href="{{ route('transport.show', $transport->id) }}" class="btn btn-primary mr-2">Detail</a>
                                    <a href="{{ route('transport.edit', $transport->id) }}" class="btn btn-warning mr-2">Edit</a>
                                    <form action="{{ route('transport.destroy', $transport->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Konfirmasi hapus data ?')" class="btn btn-danger">Hapus</button>
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
                <h3>Tidak ada Data Kendaraan</h3>
            </div> 
        @endif
    @endif

    {{-- Search View --}}
    @isset ($search_key)
        <div class="d-flex mb-3">
            <form action="{{ route('transport.search') }}" method="post" class="d-inline-block navbar-search w-100">
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
                                    <a href="{{ route('transport.show', $transport->id) }}" class="btn btn-primary mr-2">Detail</a>
                                    <a href="{{ route('transport.edit', $transport->id) }}" class="btn btn-warning mr-2">Edit</a>
                                    <form action="{{ route('transport.destroy', $transport->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Konfirmasi hapus data ?')" class="btn btn-danger">Hapus</button>
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
                <h3>Tidak ada Data {{ $search_key }} pada Tabel Kendaraan</h3>
            </div> 
        @endif
    @endisset
@endsection