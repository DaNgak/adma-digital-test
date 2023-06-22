@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        {{-- <form action="{{ route(config("data.route.admin.chairs.search")) }}" method="post" class="d-inline-block navbar-search" style="width: 60%">
            @csrf
            @method("post")
            <div class="input-group">
                <input id="inputkey" type="text" name="key" value="{{ request("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Chair Name" />
                <input id="inputtabel" type="hidden" value="{{ "test" }}" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <em class="fas fa-search fa-sm"></em>
                    </button>
                </div>
            </div>
        </form> --}}
        <a class="btn btn-primary w-sm-100" href="{{ route('merek.create') }}">Tambah Data Merek</a>
        @if ($mereks->count() > 0)
            {{-- <form action="" class="d-inline" method="post">
                @csrf
                @method("post")
                <button class="btn btn-success border-0">Generete Report</button>
            </form> --}}
            <div class="d-flex">
                <a class="btn btn-success mr-2" href="{{ "#" }}">Excel (csv)</a>
                <a class="btn btn-success" href="{{ "#" }}">Excel (xlsx)</a>
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
    @if ($mereks->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm" >
                <caption>Tabel Merek Kendaraan</caption>
                <thead>
                    <tr>
                        <th scope="col">Nomer</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mereks as $merek)        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $merek->name }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('merek.edit', $merek->id) }}" class="btn btn-warning mr-2">Edit</a>
                                <form action="{{ route('merek.destroy', $merek->id) }}" class="d-inline" method="post">
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
            {{ $mereks->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>Tidak ada Data Merek Kendaraan</h3>
        </div> 
    @endif
@endsection