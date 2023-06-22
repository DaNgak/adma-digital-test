@extends('layout.main.main')

@section('container')
	<h2 class="mb-3">Edit Data Merek Kendaraan</h2>
	<div class="col-lg-8 p-0 mb-3">
		<a class="btn btn-primary w-100 w-lg-auto" href="{{ route('merek.index') }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-lg-8 mb-5 p-0">
        <form action="{{ route('merek.update', $merek->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="name" class="form-label">Nama Merek Kendaraan</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old("name", $merek->name) }}" required>
				@error('name')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Edit Data</button>
		</form>
    </div>
@endsection