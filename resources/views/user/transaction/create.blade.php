@extends('layout.main.main')

@section('container')
	<h2 class="mb-3 fs-sm-3">Tambah Data Transaksi</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary w-sm-100" href="{{ route($transactions_route["index"]) }}">Kembali ke Data Tabel</a>
	</div>
	<div class="col-xl-8 mb-5 p-0">
		<form action="{{ route($transactions_route["store"]) }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="mb-3">
				<label for="fk_id_dormitory" class="form-label @error('fk_id_dormitory') is-invalid @enderror">Nama Penghuni Kos</label>
				@if ($dormitories->count() > 0)
					<select class="form-select" name="fk_id_dormitory" id="fk_id_dormitory" required>
						<option value="0" selected disabled>Pilih Nama Penghuni</option>
						@foreach ($dormitories as $dormitory)
							@if (old("fk_id_dormitory") == $dormitory->id)
								<option value="{{ $dormitory->id }}" selected>{{ $dormitory->name }} ( Kamar {{ $dormitory->rooms[0]->room_number }} )</option>
							@else
								<option value="{{ $dormitory->id }}">{{ $dormitory->name }} ( Kamar {{ $dormitory->rooms[0]->room_number }} )</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada data. Tambah data penghuni kos dahulu <a href="{{ route($dormitories_route["index"]) }}">disini</a></div>
				@endif
				@error('fk_id_dormitory')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>
			<span id="alert-checkin-date" class="form-control mb-3 border-1 border-danger text-danger text-wrap d-none">Data Tanggal Masuk Kos belum diset</span>
			<div id="input-date-transaction">
				<div class="mb-3">
					<label for="total_month" class="form-label">Total Bulan Bayar</label>
					<input type="number" min="1" max="12" name="total_month" class="form-control @error('total_month') is-invalid @enderror" id="total_month" value="{{ old("total_month") }}" required>
					<div class="invalid-feedback d-none" id="alert-input-month"></div>
					@error('total_month')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div class="mb-3">
					<label for="from_date" class="form-label">Dari</label>
					<div class="input-group flex-column flex-lg-row">
						<div class="d-flex flex-row w-100 w-lg-50 mb-3 mb-lg-0">
							<span class="input-group-text">Bulan</span>
							<select class="form-select @error('month_from') is-invalid @enderror" name="month_from" id="month_from" required disabled>
								@foreach ($months as $month)
									@if (old("month_from") == $month["id"])
										<option value="{{ $month["id"] }}" selected>{{ $month["name"] }}</option>
									@else
										<option value="{{ $month["id"] }}">{{ $month["name"] }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="d-flex flex-row w-100 w-lg-50">
							<span class="input-group-text">Tahun</span>
							<select class="form-select @error('year_from') is-invalid @enderror" name="year_from" id="year_from" required disabled>
								<option value="2022" selected>2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
							</select>
						</div>
					</div>
					@error('month_from')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
					@error('year_from')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="mb-3">
					<label for="to_date" class="form-label">Sampai</label>
					<div class="input-group flex-column flex-lg-row">
						<div class="d-flex flex-row w-100 w-lg-50 mb-3 mb-lg-0">
							<span class="input-group-text">Bulan</span>
							<select class="form-select @error('month_to') is-invalid @enderror" name="month_to" id="month_to" required>
								@foreach ($months as $month)
									@if (old("month_to") == $month["id"])
										<option value="{{ $month["id"] }}" selected>{{ $month["name"] }}</option>
									@else
										<option value="{{ $month["id"] }}">{{ $month["name"] }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="d-flex flex-row w-100 w-lg-50">
							<span class="input-group-text">Tahun</span>
							<select class="form-select @error('year_to') is-invalid @enderror" name="year_to" id="year_to" required>
								<option value="2022" selected>2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
							</select>
						</div>
					</div>
					@error('month_to')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
					@error('year_to')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="mb-3">
				<label for="fk_id_kind_paymentlogs" class="form-label @error('fk_id_kind_paymentlogs') is-invalid @enderror">Jenis Pembayaran</label>
				@if ($kindpaymentlogs->count() > 0)
					<select class="form-select" name="fk_id_kind_paymentlogs" id="fk_id_kind_paymentlogs" required>
						@foreach ($kindpaymentlogs as $kindpaymentlog)
							@if (old("fk_id_kind_paymentlogs") == $kindpaymentlog->id)
								<option class="{{ $kindpaymentlog->need_image ? "true" : "false" }}" value="{{ $kindpaymentlog->id }}" selected>{{ $kindpaymentlog->name }}</option>
							@else
								<option class="{{ $kindpaymentlog->need_image ? "true" : "false" }}" value="{{ $kindpaymentlog->id }}">{{ $kindpaymentlog->name }}</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">Tidak ada data. Tambah data jenis pembayaran dahulu <a href="{{ route($kindpaymentlogs_route["index"]) }}">disini</a></div>
				@endif
				@error('fk_id_kind_paymentlogs')
					<div class="invalid-feedback">
						{!! $message !!}
					</div>
				@enderror
			</div>

			<div class="mb-3 d-none" id="input-proof-payment">
				<label for="proof_payment" class="form-label">Bukti Pembayaran</label>
				<span>
					<img class="img-preview img-fluid mb-3 p-0 border-1 border-primary d-none" id="image-preview" style="border: solid">
				</span>
				<input class="form-control @error('proof_payment') is-invalid @enderror" type="file" id="proof_payment" name="proof_payment" accept="image/*">
				@error('proof_payment')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">Tambah Data</button>
		</form>
	</div>
	<script>
		const inputDormitory = document.getElementById("fk_id_dormitory");
		const inputDateTransactionContainer = document.getElementById("input-date-transaction");
		const alertCheckinDate = document.getElementById("alert-checkin-date");
		let urlajax = "{{ route("dormitory.index") }}";

		const inputTotalMonth = document.querySelector("#total_month");
		const inputFromMonth = document.querySelector("#month_from");
		const inputFromYear = document.querySelector("#year_from");
		const inputToMonth = document.querySelector("#month_to");
		const alertInputMonth = document.querySelector("#alert-input-month");

		inputDormitory.addEventListener("input", () => {
			// console.log(inputDormitory.value)
			const xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let data = JSON.parse(xhr.responseText);
					if (!data.data.success) {
						inputDateTransactionContainer.classList.add("d-none")
						alertCheckinDate.classList.remove("d-none")
						return 
					}
					inputDateTransactionContainer.classList.remove("d-none")
					alertCheckinDate.classList.add("d-none")
					inputFromMonth.value = data.data.last_month
					inputFromYear.value = data.data.last_year
				}
			};
			
			xhr.open("GET", urlajax + "/get/" + inputDormitory.value, true);
			
			xhr.send();
		})

		const inputKindPayment = document.getElementById("fk_id_kind_paymentlogs");
		const inputImageContainer = document.getElementById("input-proof-payment");
		const inputImage = document.querySelector("#proof_payment");
		const previewImage = document.querySelector("#image-preview.img-preview");

		const displayInputImage = () => {	
			previewImage.classList.remove("d-none")			
			previewImage.style.display = "block";
			previewImage.style.height = "350px";
			previewImage.style.aspectRatio = "16/9";
			previewImage.style.objectFit = "cover";
			const oFReader = new FileReader();
			oFReader.readAsDataURL(inputImage.files[0]);

			oFReader.onload = function (oFREvent) {
				previewImage.src = oFREvent.target.result;
			}
		}

		function showOrHiddenInputImage(elementInput, elementContainer) {
			if (elementInput.selectedOptions[0].className == "true") {
				elementContainer.classList.remove("d-none")
				if (inputImage.files[0] != null) {	
					displayInputImage()
				}
			} else {
				previewImage.classList.add("d-none")
				previewImage.src = ""
				elementContainer.classList.add("d-none")
				inputImage.value = null;
			}
		}

		showOrHiddenInputImage(inputKindPayment, inputImageContainer)

		inputKindPayment.addEventListener("change", (e) => {
			showOrHiddenInputImage(e.target, inputImageContainer)
		})

		inputImage.addEventListener("change", displayInputImage)

		inputTotalMonth.addEventListener("input", (e) => {
			if (inputTotalMonth.value == "") {
				alertInputMonth.classList.add("d-none");
				alertInputMonth.classList.remove("d-block");
			} else {
				if (inputTotalMonth.value > 0 && inputTotalMonth.value <= 12) {
					alertInputMonth.classList.add("d-none");
					alertInputMonth.classList.remove("d-block");
					if (parseInt(inputFromMonth.value) + parseInt(inputTotalMonth.value) > 12) {
						inputToMonth.value = parseInt(inputFromMonth.value) + parseInt(inputTotalMonth.value) - 12	
					} else {
						inputToMonth.value = parseInt(inputFromMonth.value) + parseInt(inputTotalMonth.value)
					}
				} else {
					alertInputMonth.classList.remove("d-none");
					alertInputMonth.classList.add("d-block");
					alertInputMonth.innerHTML = "The total month must be between 1 and 12";
				}
			}
		})

		inputToMonth.addEventListener("input", () => {
			if (parseInt(inputToMonth.value) - parseInt(inputFromMonth.value) <= 0) {
				inputTotalMonth.value = 12 + (parseInt(inputToMonth.value) - parseInt(inputFromMonth.value)) 	
			} else {
				inputTotalMonth.value = parseInt(inputToMonth.value) - parseInt(inputFromMonth.value)
			}
		})
	</script>
@endsection