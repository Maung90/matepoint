<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - List Pembayaran')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endsection
@section('content') 
<!-- content -->

<div class="overflow-hidden shadow-none card bg-light-info position-relative">
  <div class="px-4 py-3 card-body">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="mb-8 fw-semibold">List Pembayaran</h4>
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
  <div class="card-body"> 
    <div class="table">
      <div class="table-responsive">
        <table id="datatables" class="table border">
          <thead>
            <tr>
                <th>No</th>
                <th>Kode Pembayaran</th>
                <th>Customer</th>
                <th>Worker</th>
                <th>Status Bayar</th>
                <th>Sharing Session</th>
                <th>Status Konsultasi</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="upload-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    <form id="upload-bukti" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put') 
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myModalLabel">
            Edit Status 
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
          <div class="form-group">
            <label for="bukti_bayar">Upload Bukti Bayar:</label>
            <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar" required>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="font-medium btn btn-light-success text-success waves-effect">
            Save
          </button>
          <button type="button" class="font-medium btn btn-light-danger text-danger waves-effect" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </div> 
    </form>
  </div> 
</div> 

<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    
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
                <div class="my-1 col-12">
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
                        Status Pembayaran
                      </td>
                      <td id="statusPembayaran" class="text-capitalize">
                        -
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Status Konsul
                      </td>
                      <td id="statusKonsul" class="text-capitalize">
                        -
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Sharing Session
                      </td>
                      <td id="sharingSession" class="text-capitalize">
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
                  <img src="https://penerbitininnawa.id/assets/admin/img/default.png" id="bukti_pembayaran" alt="bukti pembayaran" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div> 
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-md">
		<form id="update" method="POST">
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
          <div class="mb-3">
            <label for="update_status_bayar">Status Bayar</label>
            <select name="status_bayar" id="update_status_bayar" class="form-select" required>
              <option value="paid">Paid</option>
              <option value="unpaid">Unpaid</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="update_sharing_session">Sharing Session</label>
            <select name="sharing_session" id="update_sharing_session" class="form-select" required>
              <option value="offline">Offline</option>
              <option value="online">Online</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="update_status_konsul">Status Konsul</label>
            <select name="status_konsul" id="update_status_konsul" class="form-select" required>
              <option value="proses">Proses</option>
              <option value="sukses">Sukses</option>
            </select>
          </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="font-medium btn btn-light-success text-success waves-effect">
						Save
					</button>
					<button type="button" class="font-medium btn btn-light-danger text-danger waves-effect" data-bs-dismiss="modal">
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
<script>
$(document).ready(function() {
    // Event handler for upload button
    $(document).on('click', '.upload-btn', function() {
        let id = $(this).data('id');
        $('#idd_pembayaran').val(id);
    });

    // DataTables initialization
    $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('pembayaran.tableAdmin') }}',
        columns: [
            { data: 'no', name: 'no' },
            { data: 'kode_pembayaran', name: 'kode_pembayaran' },
            { data: 'nama_customer', name: 'nama_customer' },
            { data: 'nama_worker', name: 'nama_worker' },
            { data: 'status_bayar', name: 'status_bayar' },
            { data: 'sharing_session', name: 'sharing_session' },
            { data: 'status_konsul', name: 'status_konsul' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ]
    });

    // Event handler for info button
    $(document).on('click', '.info-btn', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route("pembayaran.get", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(response) {
                let data = response[0];
                $('#kode_pembayaran').text(data.kode_pembayaran);
                $('#nama_customer').text(data.customer.name);
                $('#nama_worker').text(data.worker.name);
                $('#statusPembayaran').text(data.status_bayar);
                $('#sharingSession').text(data.sharing_session);
                $('#statusKonsul').text(data.status_konsul);
                $('#harga').text('Rp. ' + parseInt(data.harga).toLocaleString('id-ID'));
                if (data.bukti_bayar) {
                  $('#bukti_pembayaran').attr('src', 'storage/' + data.bukti_bayar);
                } else {
                  $('#bukti_pembayaran').attr('src', 'https://penerbitininnawa.id/assets/admin/img/default.png');
                }

                $('#info-modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });

    // Event handler for edit button
    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route("pembayaran.get", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(response) {
                let data = response[0];

                $('#update_status_bayar').val(data.status_bayar);
                $('#update_sharing_status').val(data.sharing_status);
                $('#update_status_konsul').val(data.status_konsul);

                let updateUrl = '{{ route("pembayaran.update", ":id") }}'.replace(':id', id);
                $('#update').attr('action', updateUrl);

                $('#edit-modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });

    // Event handler for upload button
    $(document).on('click', '.upload-btn', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ route("pembayaran.get", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(response) {
                let updateUrl = '{{ route("upload.bukti", ":id") }}'.replace(':id', id);
                $('#upload-bukti').attr('action', updateUrl);

                $('#upload-modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });
    
    $('#upload-bukti').submit(function(e) {
      e.preventDefault();
      let actionUrl = $(this).attr('action');
      let formData = new FormData(this);

      $.ajax({
          url: actionUrl,
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              $('#upload-modal').modal('hide');
              $('#datatables').DataTable().ajax.reload();
              Swal.fire({
                  title: 'Success!',
                  text: response.message,
                  icon: 'success',
                  confirmButtonText: 'OK'
              });
          },
          error: function(xhr, status, error) {
              console.error("Error updating data:", error);
              let errorMessage = "There was an error uploading data.";
              if (xhr.status === 422) {
                  let errors = xhr.responseJSON.message;
                  errorMessage = '<ul>';
                  $.each(errors, function(key, messages) {
                      errorMessage += '<li>' + messages.join(', ') + '</li>';
                  });
                  errorMessage += '</ul>';
              }
              Swal.fire({
                  title: 'Error!',
                  html: errorMessage,
                  icon: 'error',
                  confirmButtonText: 'OK'
              });
          }
      });
    });

    // Form submission handler for update
    $('#update').submit(function(e) {
        e.preventDefault();
        let actionUrl = $(this).attr('action');

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#edit-modal').modal('hide');
                $('#datatables').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr, status, error) {
                console.error("Error updating data:", error);
                Swal.fire({
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'There was an error updating data.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Event handler for delete button
    $(document).on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        let deleteUrl = '{{ route("pembayaran.destroy", ":id") }}'.replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#datatables').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting data:", error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error deleting the data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
});
</script>

@endsection

