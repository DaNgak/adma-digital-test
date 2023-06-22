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
    @if ($mereks->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm" >
                <caption>Tabel Merek Sampah</caption>
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
                                <form action="{{ route('merek.trash.restore', $merek->id) }}" class="d-inline" method="post">
                                    @csrf
                                    @method("put")
                                    <button onclick="return confirm('Konfirmasi restore data ?')" class="btn btn-warning mr-2">Restore</button>
                                </form>
                                <form action="{{ route('merek.trash.destroy', $merek->id) }}" class="d-inline" method="post">
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
            {{ $mereks->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>Tidak ada Data Sampah Merek Kendaran</h3>
        </div> 
    @endif
@endsection