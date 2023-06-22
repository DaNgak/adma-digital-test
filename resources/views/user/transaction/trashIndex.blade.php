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
    @if ($rooms->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm" >
                <caption></caption>
                <style>
                    table.table thead tr th:nth-child(1)    , 
                    table.table tbody tr td:nth-child(1){
                        text-align: center
                    }

                    table.table tbody tr td{
                        vertical-align: middle !important;
                    }
                </style>
                <thead>
                    <tr>
                        <th scope="col">Nomer Kamar</th>
                        <th scope="col">Nama Penghuni Kamar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{!! $room->dormitory->name ?? '<i class="text-danger">Tidak Ada Penghuni</i>'!!}</td>
                            <td class="d-flex">
                                <a href="{{ route($rooms_route["trashDetail"], $room->id) }}" class="btn btn-primary mr-2">Detail</a>
                                <a href="{{ route($rooms_route["trashRestore"], $room->id) }}" class="btn btn-warning mr-2" onclick="return confirm('Restore data kamar nomer {{ $room->room_number }}, Konfirmasi ?')" >Restore</a>
                                <form action="{{ route($rooms_route["trashDelete"], $room->id) }}" class="d-inline" method="post">
                                    @csrf
                                    @method("delete")
                                    <button onclick="return confirm('Data akan dihapus secara permanent, Konfirmasi ?')" class="btn btn-danger">Hapus Permanent</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $rooms->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>Tidak ada data sampah pada tabel Kamar</h3>
        </div> 
    @endif

@endsection