@extends('layout.main.main')

@section('container')
	<h2 class="mb-3">Edit Data Penghuni {{ $room->name }}</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route($rooms_route["index"]) }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-md-8 mb-5 p-0">
        <form action="{{ route($rooms_route["update"], $room->id) }}" method="post">
			@csrf
            @method("put")

			<div class="mb-3">
				<label for="fk_id_dormitory" class="form-label">Nama Kamar</label>
				<select name="fk_id_dormitory" class="form-select @error('fk_id_dormitory') is-invalid @enderror" id="fk_id_dormitory" required autofocus>
					@if (!$room->fk_id_dormitory)			
						<option value="0" selected>Tidak Ada Penghuni</option>
					@endif
					@foreach ($dormitories as $dormitory)
						@if (old("fk_id_dormitory", $room->fk_id_dormitory) == $dormitory->id)
							<option value="{{ $dormitory->id }}" selected>{{ $dormitory->name }}</option>
						@else
							<option value="{{ $dormitory->id }}">{{ $dormitory->name }}</option>
						@endif
					@endforeach
				</select>
				@error('fk_id_dormitory')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="room_number" class="form-label">Nomer Kamar</label>
				<input type="number" name="room_number" class="form-control @error('room_number') is-invalid @enderror" id="room_number" value="{{ old("room_number", $room->room_number) }}" required>
				@error('room_number')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Edit Data</button>
		</form>
    </div>
@endsection