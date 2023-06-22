@extends('layout.main.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <a class="btn btn-primary col-12 col-md-auto mb-3 mb-md-0" href="{{ route('dashboard.index') }}">Kembali ke Dashboard</a>
    </div>
    {{-- Index View --}}
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
                        <th scope="col">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transports as $transport)        
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transport->name }}</td>
                            <td>{{ $transport->license_plate }}</td>
                            <td>{{ $transport->size_passenger }} Orang</td>
                            <td>{!! $transport->merek->name ?? '<b class="text-danger">-</b>' !!}</td>
                            @if ($transport->image)
                                <td style="max-width: 200px;"><img src={{ asset("storage/" . $transport->image) }} class="img-preview img-fluid rounded" id="image-preview" style="display: block; aspect-ratio: 16/9; object-fit:cover;"></td>
                            @else
                                <td><b class="text-danger">Tidak ada Gambar</b></td>
                            @endif
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
            <h3>Tidak ada Daftar Kendaraan</h3>
        </div> 
    @endif
@endsection