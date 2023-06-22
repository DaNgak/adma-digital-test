@extends('layout.main.main')

@section('container')
	<h2 class="mb-3">Edit Data Harga Order</h2>
	<div class="col-lg-8 p-0 mb-3">
		<a class="btn btn-primary w-100 w-lg-auto" href="{{ route('pricing-order-transport.index') }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-lg-8 mb-5 p-0">
        <form action="{{ route('pricing-order-transport.update', $pricingOrder->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="location_start_id" class="form-label @error('location_start_id') is-invalid @enderror">Lokasi Berangkat</label>
				@if ($location_starts->count() > 0)
					<select class="form-select" name="location_start_id" id="location_start_id" required>
						<option value="0" selected disabled>Pilih Lokasi 1</option>
						@foreach ($location_starts as $location_start)
							@if (old("location_start_id", $pricingOrder->location_start_id) == $location_start->id)
								<option value="{{ $location_start->id }}" selected>{{ $location_start->name }} ({{ $location_start->province }})</option>
							@else
								<option value="{{ $location_start->id }}">{{ $location_start->name }} ({{ $location_start->province }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Lokasi. Tambah Data Lokasi dahulu <a href="{{ route('pricing-order-transport.index') }}">disini</a></div>
				@endif
				@error('location_start_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="location_finish_id" class="form-label @error('location_finish_id') is-invalid @enderror">Lokasi Tujuan</label>
				@if ($location_finishs->count() > 0)
					<select class="form-select" name="location_finish_id" id="location_finish_id" required>
						<option value="0" selected disabled>Pilih Lokasi 2</option>
						@foreach ($location_finishs as $location_finish)
							@if (old("location_finish_id", $pricingOrder->location_finish_id) == $location_finish->id)
								<option value="{{ $location_finish->id }}" selected>{{ $location_finish->name }} ({{ $location_finish->province }})</option>
							@else
								<option value="{{ $location_finish->id }}">{{ $location_finish->name }} ({{ $location_finish->province }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Lokasi. Tambah Data Lokasi dahulu <a href="{{ route('pricing-order-transport.index') }}">disini</a></div>
				@endif
				@error('location_finish_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="distance" class="form-label">Jarak Perjalanan</label>
				<input type="number" name="distance" class="form-control @error('distance') is-invalid @enderror" id="distance" value="{{ old("distance", $pricingOrder->distance) }}" required>
				@error('distance')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Harga Travel</label>
				<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old("price", $pricingOrder->price) }}" required>
				@error('price')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Edit Data</button>
		</form>
    </div>
@endsection