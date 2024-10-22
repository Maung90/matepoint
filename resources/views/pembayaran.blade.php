<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - List Pembayaran')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endsection
@section('content') 
<!-- content -->

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
	<div class="card-body px-4 py-3">
		<div class="row align-items-center">
			<div class="col-9">
				<h4 class="fw-semibold mb-8">List Pembayaran</h4>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a class="text-muted " href="/">Dashboard</a></li>
						<li class="breadcrumb-item" aria-current="page">Pembayaran</li>
					</ol>
				</nav>
			</div>
			<div class="col-3">
				<div class="text-center mb-n5">  
					<img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card"> 
	<div class="card-body px-4 py-3"> 
		<div class="table-responsive">
			<table class="table table-bordered" id="zero_config">
				<thead>
					<tr>
						<th>Kode Pembayaran</th>
						<th>Customer ID</th>
						<th>Worker ID</th>
						<th>Harga</th>
						<th>Status Bayar</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody> 
					@foreach ($pembayarans as $pembayaran)
					<tr>
						<td>{{ $pembayaran->kode_pembayaran }}</td>
						<td>{{ $pembayaran->nama_customer }}</td>
						<td>{{ $pembayaran->nama_worker }}</td>
						<td>{{ $pembayaran->harga }}</td>
						<td>
							<span class="badge bg-{{$pembayaran->status_bayar == 'paid' ? 'success' : 'danger' }}">
								{{ $pembayaran->status_bayar }}
							</span>
						</td>
						<td>
							<button type="button" class="btn btn-sm waves-effect waves-light btn-primary info-btn" data-id="{{$pembayaran->id}}" data-bs-toggle="modal" data-bs-target="#info-modal ">
								<i class="ti ti-info-circle"></i>
							</button>
							<button type="button" class="btn btn-sm waves-effect waves-light btn-warning edit-btn" data-id="{{$pembayaran->id}}" data-bs-toggle="modal" data-bs-target="#edit-modal ">
								<i class="ti ti-pencil"></i>
							</button>
							<button type="button" class="btn btn-sm waves-effect waves-light btn-danger delete-btn" id="sa-confirm" data-id="{{$pembayaran->id}}">
								<i class="ti ti-trash"></i>
							</button> 

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-sm">
		<form action="POST" id="updateForm">
			@csrf
			@method('PUT')
			<div class="modal-content">
				<div class="modal-header d-flex align-items-center">
					<h4 class="modal-title" id="myModalLabel">
						Edit Status 
					</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body"> 
					<select name="status_bayar" id="status_bayar" class="form-select" required>
						<option value="paid">paid</option>
						<option value="nonpaid">nonpaid</option>
					</select>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-light-success text-success font-medium waves-effect">
						Save
					</button>
					<button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
						Close
					</button>
				</div>
			</div> 
		</form>
	</div> 
</div>

<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-md">
		<form action="POST" id="updateForm"> 
			<div class="modal-content">
				<div class="modal-header d-flex align-items-center">
					<h4 class="modal-title" id="myModalLabel">
						Info Pembayaran
					</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body"> 
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12 my-1">
									<table class="table table-bordered">
										<tr>
											<td>
												Kode Pembayaran
											</td>
											<td id="kode_pembayaran"> 
												-
											</td>
										</tr>
										<tr>
											<td>
												Customer
											</td>
											<td id="nama_customer">
												-
											</td>
										</tr>
										<tr>
											<td>
												Worker
											</td>
											<td id="nama_worker">
												-
											</td>
										</tr>
										<tr>
											<td>
												Harga
											</td>
											<td id="harga">
												-
											</td>
										</tr>
									</table> 
								</div>
								<div class="col-12">
									<span class="text-muted">Bukti Pembayaran : </span>
									<img src="{{asset('dist/images/apps/app-email.jpg')}}" id="bukti_pembayaran" alt="bukti pembayaran" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-light-success text-success font-medium waves-effect">
						Save
					</button>
					<button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
						Close
					</button>
				</div>
			</div> 
		</form>
	</div> 
</div>
<!-- content -->
@endsection
@section('js')
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script>

	$(document).ready(function() {
		$("#zero_config").DataTable();
		// Saat tombol edit diklik
		$('.edit-btn').click(function() {
			let id = $(this).data('id'); // Ambil ID dari data-id tombol
			let url = '/pembayaran/' + id; // Buat URL untuk AJAX

			// AJAX request untuk mendapatkan data pembayaran
			$.ajax({
				url: url,
				type: 'GET',
				success: function(response) { 
					// Set nilai status_bayar di form modal
					$('#status_bayar').val(response.status_bayar);

					// Update action form untuk update data
					$('#updateForm').attr('action', '/pembayaran/' + id);
				}
			});
		});
		$('.info-btn').click(function() {
			let id = $(this).data('id'); // Ambil ID dari data-id tombol
			let url = '/pembayaran/get/' + id; // Buat URL untuk AJAX
			let img = '';
			// AJAX request untuk mendapatkan data pembayaran
			$.ajax({
				url: url,
				type: 'GET',
				success: function(response) {  
					$('#kode_pembayaran').text(''+response[0].kode_pembayaran);
					$('#nama_customer').text(''+response[0].nama_customer);
					$('#nama_worker').text(''+response[0].nama_worker);
					$('#harga').text('Rp. '+ response[0].harga);
					img = '{{asset("assets/images/alert/")}}/'+response[0].bukti_bayar; 
					$('#bukti_pembayaran').attr('src',img);
					// console.log(response)
				}
			});
		});
	});

	$('#updateForm').on('submit', function(e) {
    e.preventDefault(); // Mencegah submit default form

    let formAction = $(this).attr('action'); // Ambil action dari form
    let formData = $(this).serialize(); // Serialisasi semua data form

    // AJAX request untuk menyimpan perubahan
    $.ajax({
    	url: formAction,
    	type: 'PUT',
        data: formData, // Kirim semua data form
        success: function(response) {
            // Jika sukses, tutup modal dan refresh halaman
        	Swal.fire({
        		title: "Success!",
        		text: "Data has been updated.",
        		icon: "success",
        		confirmButtonText: "OK"
        	}).then((result) => {
        		if (result.isConfirmed) {
                    $('#editModal').modal('hide'); // Tutup modal
                    location.reload(); // Reload halaman untuk menampilkan perubahan
                }
            });
        },
        error: function(response) {
            // Jika gagal, tampilkan pesan error
        	Swal.fire({
        		title: "Error!",
        		text: "Failed to update data.",
        		icon: "error",
        		confirmButtonText: "OK"
        	});
        }
    });
});


	!(function ($) {
		"use strict";

		var SweetAlert = function () {};

    //examples
		(SweetAlert.prototype.init = function () { 

			$(".delete-btn").click(function () {
				let pembayaranId = $(this).data('id');
				var url = "/pembayaran/" + pembayaranId;

				Swal.fire({
					title: "Are you sure?",
					text: "You won't be able to revert this!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Yes, delete it!",
				}).then((result) => {

					if (result.isConfirmed) {
						$.ajax({
							url: url,
							type: 'DELETE',
							data: {
								"_token": "{{ csrf_token() }}"  // Sertakan CSRF token untuk keamanan
							},
							success: function(response) {
								Swal.fire({
									title: "Deleted!",
									text: "Data has been deleted.",
									icon: "success",
									confirmButtonText: "OK"
								}).then(() => {
									location.reload();  
								});
							},
							error: function(response) {
								Swal.fire({
									title: "Error!",
									text: "Failed to delete data.",
									icon: "error",
									confirmButtonText: "OK"
								});
							}
						});

						
					}
				});
			}); 
		}),
      //init
		($.SweetAlert = new SweetAlert()),
		($.SweetAlert.Constructor = SweetAlert);
	})(window.jQuery),
    //initializing
	(function ($) {
		"use strict";
		$.SweetAlert.init();
	})(window.jQuery);
</script>

@endsection

