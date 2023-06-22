@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('location.create') }}">Tambah Data Lokasi</a>
        @if ($locations->count() > 0)
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
        @if ($locations->count() > 0)
            <div class="d-flex mb-3">
                <form action="{{ route('location.search') }}" method="post" class="d-inline-block navbar-search w-100">
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
                    <caption>Tabel Lokasi</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Kabupaten / Kota</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->province }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('location.edit', $location->id) }}" class="btn btn-warning mr-2">Edit</a>
                                    <form action="{{ route('location.destroy', $location->id) }}" class="d-inline" method="post">
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
                {{ $locations->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data Lokasi</h3>
            </div> 
        @endif
    @endif
    {{-- Search View --}}
    @isset ($search_key)
        <div class="d-flex mb-3">
            <form action="{{ route('location.search') }}" method="post" class="d-inline-block navbar-search w-100">
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
        @if ($locations->count() > 0)
            <div class="table-responsive mb-5">
                <table class="table table-striped table-sm" >
                    <caption>Tabel Lokasi</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomer</th>
                            <th scope="col">Kabupaten / Kota</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->province }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('location.edit', $location->id) }}" class="btn btn-warning mr-2">Edit</a>
                                    <form action="{{ route('location.destroy', $location->id) }}" class="d-inline" method="post">
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
                {{ $locations->links() }}
            </div>
        @else
            <div class="d-flex">
                <h3>Tidak ada Data {{ $search_key }} pada Tabel Lokasi</h3>
            </div> 
        @endif
    @endisset
@endsection