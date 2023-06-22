@extends('layout.main.main')

@section('container')
	<h2 class="mb-3 fs-sm-3">Tambah Data Pesanan</h2>
	<div class="text-info mb-3">
		<span>Note* : Tanggal Keberangkatan minimal adalah besok yaitu (<span id="date-tomorrow"></span>) </span> <br/>
		<span>Note* : Lokasi berangkat dan tujuan tidak boleh sama </span>
	</div>
	<div class="col-lg-8 p-0 mb-3">
		<a class="btn btn-primary w-100 w-lg-auto" href="{{ route('order.index') }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-lg-8 mb-5 p-0">
		<form action="{{ route('order.store') }}" method="post">
			@csrf
			<div class="mb-3">
				<label for="location_start_id" class="form-label @error('location_start_id') is-invalid @enderror">Pilih Lokasi Awal</label>
				@if ($locations->count() > 0)
					<select class="form-select" name="location_start_id" id="location_start_id" required>
						<option value="0" selected disabled>Pilih Lokasi Awal</option>
						@foreach ($locations as $location)
							@if (old("location_start_id") == $location->id)
								<option value="{{ $location->id }}" selected>{{ $location->name }} ({{ $location->province }})</option>
							@else
								<option value="{{ $location->id }}">{{ $location->name }} ({{ $location->province }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Lokasi.</div>
				@endif
				@error('location_start_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="location_finish_id" class="form-label @error('location_finish_id') is-invalid @enderror">Pilih Lokasi Tujuan</label>
				@if ($locations->count() > 0)
					<select class="form-select" name="location_finish_id" id="location_finish_id" required>
						<option value="0" selected disabled>Pilih Lokasi Awal</option>
						@foreach ($locations as $location)
							@if (old("location_finish_id") == $location->id)
								<option value="{{ $location->id }}" selected>{{ $location->name }} ({{ $location->province }})</option>
							@else
								<option value="{{ $location->id }}">{{ $location->name }} ({{ $location->province }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Lokasi.</div>
				@endif
				@error('location_finish_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="transport_id" class="form-label @error('transport_id') is-invalid @enderror">Pilih Kendaraan</label>
				@if ($transports->count() > 0)
					<select class="form-select" name="transport_id" id="transport_id" required>
						<option value="0" selected disabled>Pilih Kendaraan</option>
						@foreach ($transports as $transport)
							@if (old("transport_id") == $transport->id)
								<option value="{{ $transport->id }}" selected>{{ $transport->name }}</option>
							@else
								<option value="{{ $transport->id }}">{{ $transport->name }}</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Kendaraan.</div>
				@endif
				@error('transport_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="date_pickup" class="form-label">Tanggal Keberangkatan</label>
				<input type="date" name="date_pickup" class="form-control @error('date_pickup') is-invalid @enderror" id="date_pickup" value="{{ old("date_pickup", date('m/d/Y')) }}" required>
				@error('date_pickup')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="pickup_location" class="form-label">Lokasi Penjemputan</label>
				<input type="text" name="pickup_location" class="form-control @error('pickup_location') is-invalid @enderror" id="pickup_location" value="{{ old("pickup_location") }}" required>
				@error('pickup_location')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="total_passanger" class="form-label">Total Penumpang</label>
				<input type="number" name="total_passanger" class="form-control @error('total_passanger') is-invalid @enderror" id="total_passanger" value="{{ old("total_passanger", 0) }}" required>
				@error('total_passanger')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">Tambah Data</button>
		</form>
	</div>
	<script>
		let currentDate = new Date();
		currentDate.setDate(currentDate.getDate() + 1);

		let year = currentDate.getFullYear();
		let month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
		let day = ("0" + currentDate.getDate()).slice(-2);
		document.getElementById("date-tomorrow").innerHTML = currentDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });;
		document.getElementById("date_pickup").value = year + "-" + month + "-" + day;
	</script>
@endsection