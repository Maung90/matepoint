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
      <div> 
      <table class="table table-bordered" id="zero_config">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pembayaran</th>
            <th>Customer ID</th>
            <th>Worker ID</th>
            <th>Harga</th>
            <th>Status Konsultasi</th>
            <th>Status Bayar</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> 
          <?php $no = 0; ?>
          @foreach ($pembayarans as $pembayaran)
          <?php $no++; ?>
          <tr>
            <td>{{$no}}</td>
            <td>{{ $pembayaran->kode_pembayaran }}</td>
            <td>{{ $pembayaran->nama_customer }}</td>
            <td>{{ $pembayaran->nama_worker }}</td>
            <td>{{ $pembayaran->harga }}</td>
            <td>
              <span class="badge bg-{{$pembayaran->statusKonsul == 'proses' ? 'warning' : 'primary' }}">
                {{ $pembayaran->statusKonsul }}
              </span>
            </td>
            <td>
              <span class="badge bg-{{$pembayaran->status_bayar == 'paid' ? 'success' : 'danger' }}">
                {{ $pembayaran->status_bayar }}
              </span>
            </td>
            <td>
              <button type="button" class="btn btn-sm waves-effect waves-light btn-primary info-btn" data-id="{{$pembayaran->idPembayaran}}" data-bs-toggle="modal" data-bs-target="#info-modal ">
                <i class="ti ti-info-circle"></i>
              </button>
              <button type="button" class="btn btn-sm waves-effect waves-light btn-primary upload-btn" data-id="{{$pembayaran->idPembayaran}}" data-bs-toggle="modal" data-bs-target="#upload-modal ">
                <i class="ti ti-upload"></i>
              </button>  
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="upload-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <form action="{{ route('upload.bukti') }}" method="POST" enctype="multipart/form-data">
      @csrf 
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
          <input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id}}" id="idd_pembayaran"> 
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
                        Status Konsul
                      </td>
                      <td id="statusKonsul">
                        -
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Sharing Session
                      </td>
                      <td id="sharingSession">
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
 
<script>

  $(document).ready(function() {
    $("#zero_config").DataTable();
    // Saat tombol edit diklik
    $('.upload-btn').click(function() {
      let id = $(this).data('id'); // Ambil ID dari data-id tombol
      
      $('#idd_pembayaran').val(id);
      
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
          // console.log(response)
          $('#kode_pembayaran').text(''+response[0].kode_pembayaran);
          $('#nama_customer').text(''+response[0].nama_customer);
          $('#nama_worker').text(''+response[0].nama_worker);
          $('#sharingSession').text(''+response[0].sharingSession);
          $('#statusKonsul').text(''+response[0].statusKonsul);
          $('#harga').text('Rp. '+ response[0].harga);
          // img = '{{asset("assets/images/alert/")}}/'+; 
          $('#bukti_pembayaran').attr('src','storage/'+response[0].bukti_bayar);
        }
      });
    });
  });
 
 
</script>

@endsection

