@extends('layout.main.main')

@section('container')
	<h2 class="mb-3">Edit Data Transport</h2>
	<div class="col-lg-8 p-0 mb-3">
		<a class="btn btn-primary w-100 w-lg-auto" href="{{ route('transport.index') }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-lg-8 mb-5 p-0">
        <form action="{{ route('transport.update', $transport->id) }}" method="post" enctype="multipart/form-data">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="name" class="form-label">Nama Kendaraan</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old("name", $transport->name) }}" required>
				@error('name')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="license_plate" class="form-label">Plat Nomer Kendaraan</label>
				<input type="text" name="license_plate" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" value="{{ old("license_plate", $transport->license_plate) }}" required>
				@error('license_plate')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="merek_id" class="form-label @error('merek_id') is-invalid @enderror">Merek Kendaraan</label>
				@if ($mereks->count() > 0)
					<select class="form-select" name="merek_id" id="merek_id" required>
						<option value="0" selected disabled>Pilih Merek</option>
						@foreach ($mereks as $merek)
							@if (old("merek_id", $transport->merek_id) == $merek->id)
								<option value="{{ $merek->id }}" selected>{{ $merek->name }}</option>
							@else
								<option value="{{ $merek->id }}">{{ $merek->name }}</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada Data Merek. Tambah Data Merek Kendaraan dahulu <a href="{{ route('merek.index') }}">disini</a></div>
				@endif
				@error('merek_id')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="size_passenger" class="form-label">Kapasitas Penumpang</label>
				<input type="number" name="size_passenger" class="form-control @error('size_passenger') is-invalid @enderror" id="size_passenger" value="{{ old("size_passenger", $transport->size_passenger) }}" required>
				@error('size_passenger')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="image" class="form-label">Gambar Kendaraan</label>
				<span>
					@if ($transport->image)
						<img src={{ asset("storage/" . $transport->image) }} class="img-preview img-fluid col-lg-10 col-xl-8 mb-3 p-0 border-1 border-primary" id="image-preview" style="display: block; aspect-ratio: 16/9; object-fit:cover; border:solid;">
					@else
						<img class="img-preview img-fluid col-lg-10 col-xl-8 mb-3 p-0 border-1 border-primary d-none" id="image-preview" style="border: solid">
					@endif
				</span>
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
				<div class="my-2">
					<button type="button" id="btn-clear-image" class="btn btn-danger">Clear Input Gambar</button>
				</div>
				@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror

			</div>
			
			<button type="submit" class="btn btn-warning">Edit Data</button>
		</form>
	</div>
	<script>
		let srcImage = null
		const inputImage = document.querySelector("#image");
		const previewImage = document.querySelector("#image-preview.img-preview");
		const btnClearImage = document.getElementById('btn-clear-image');
		
		if (previewImage.hasAttribute("src")) {
			srcImage = previewImage.src;
		}

		// Handle Clear Input Image
		btnClearImage.addEventListener('click', () => {
			inputImage.value = "";
			if (srcImage == null) {
				previewImage.classList.add("d-none")	
				previewImage.removeAttribute("src");
			} else {
				previewImage.src = srcImage;
			}
		})

		// Handle Input Image
		const displayInputImage = () => {	
			previewImage.classList.remove("d-none")			
			previewImage.style.display = "block";
			// previewImage.style.height = "350px";
			previewImage.style.aspectRatio = "16/9";
			previewImage.style.objectFit = "cover";
			const oFReader = new FileReader();
			oFReader.readAsDataURL(inputImage.files[0]);

			oFReader.onload = function (oFREvent) {
				previewImage.src = oFREvent.target.result;
			}
		}

		if (inputImage.files[0] != null) {	
			displayInputImage()
		}

		inputImage.addEventListener("change", displayInputImage) 
	</script>
@endsection