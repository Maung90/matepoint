<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Matepoint - Dashboard')

@section('content') 
<!-- content -->

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Talent</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted " href="./index.html">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Talent</li>
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
<div class="card overflow-hidden chat-application"> 
  <div class="mx-3">
    <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center justify-content-end">
      <div>
        <input type="text" name="#" id="search" class="form-control" placeholder="seacrh" autocomplete="off"> 
      </div>
    </div> 
    <div class="row" id="searchResults">
      @foreach ($users as $profesional)
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch ">
        <div class="card w-100 bg-light">
          <div class="p-4 d-flex align-items-stretch h-100">
            <div class="row">
              <div class="col-4 col-md-3 d-flex align-items-center">
                <img src="{{asset('assets/images/profile/user-1.jpg')}}" class="rounded img-fluid" />
              </div>
              <div class="col-8 col-md-9 d-flex align-items-center">
                <div>
                  <span class="text-dark fs-4 link lh-sm">
                    {{$profesional->name}}
                  </span>
                  <h6 class="card-subtitle mt-2 mb-0 fw-normal text-muted">
                    {{$profesional->email}}
                  </h6>
                </div>
              </div>
              <div class="col-12 d-flex align-items-center gap-1 mt-2 justify-content-end">
                <button class="btn btn-sm btn-outline-primary btn-inpo" data-bs-toggle="modal" data-bs-target="#modal-inpo" data-id="{{$profesional->id}}">
                  Info profesional
                </button>
                <button class="btn btn-sm btn-outline-success btn-konsul" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md"  data-id="{{$profesional->id}}"> 
                  Konsultasi
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="modal fade" id="modal-inpo" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="myModalLabel">
          Informasi profesional
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th colspan="2">
              <img src="{{asset('assets/images/profile/user-1.jpg')}}" class="rounded img-fluid" />
            </th> 
          </tr>
          <tr>
            <th>Nama </th> 
            <td id="name2"> - </td>
          </tr>
          <tr>
            <th>Email</th> 
            <td id="email2"> - </td>
          </tr>
          <tr>
            <th>No telp  </th> 
            <td id="notelp2"> - </td>
          </tr> 
        </table>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>  
  </div>  
</div>
<div class="modal fade" id="bs-example-modal-md" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <form action="{{ route('profesional.store') }}" method="POST" id="updateForm">
      @csrf <!-- Token CSRF untuk proteksi -->
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myModalLabel">
            Sharing Session & Payment
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h2 class="fs-3 text-muted text-capitalize">Silahkan bayar biaya konsultasi</h2>
          <h5 class="text-dark" id="harga">Rp. 0.000</h5>
          <div class="row">
            <div class="col-12">
              <img src="{{asset('assets/images/qr.png')}}" alt="">
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-center gap-2">
                <input type="hidden" name="id_worker" id="id_worker">
                <input type="hidden" name="id_customer" id="id_customer" value="{{session('user_id')}}">
                <input type="hidden" name="harga_worker" id="harga_worker">
                <input type="radio" class="form-check" name="sharingSession" id="offline" value="offline">
                <label for="offline" class="fw-bolder text-muted">Offline</label>
                <input type="radio" id="online" class="form-check" name="sharingSession" value="online">
                <label for="online" class="fw-bolder text-muted">Online</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-light-success text-success font-medium waves-effect" id="btnNextModal">
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
<script type="text/javascript">
  $(document).ready(function() {

    $('#search').on('keyup', function() {
      let query = $(this).val();

                if (query.length > 1) { // Hanya lakukan pencarian jika panjang query lebih dari 1
                  $.ajax({
                    url: "{{ route('profesional.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function(data) {
                            $('#searchResults').html(''); // Bersihkan hasil sebelumnya
                            if (data.length > 0) {
                              $.each(data, function(key, result) {
                                    // Struktur card Bootstrap
                                let card = `
                                <div class="col-md-6 col-lg-4 d-flex align-items-stretch ">
                                  <div class="card w-100 bg-light">
                                    <div class="p-4 d-flex align-items-stretch h-100">
                                      <div class="row">
                                        <div class="col-4 col-md-3 d-flex align-items-center">
                                          <img src="{{asset('assets/images/profile/user-1.jpg')}}" class="rounded img-fluid" />
                                        </div>
                                        <div class="col-8 col-md-9 d-flex align-items-center">
                                          <div>
                                            <span class="text-dark fs-4 link lh-sm">
                                              ${result.name}
                                            </span>
                                            <h6 class="card-subtitle mt-2 mb-0 fw-normal text-muted">
                                              ${result.email}
                                            </h6>
                                          </div>
                                        </div>
                                        <div class="col-12 d-flex align-items-center gap-1 mt-2 justify-content-end">
                                          <button class="btn btn-sm btn-outline-primary btn-inpo" data-bs-toggle="modal" data-bs-target="#modal-inpo" data-id="${result.id}">
                                            Info Talent
                                          </button>
                                          <button class="btn btn-sm btn-outline-success btn-konsul" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md"  data-id="${result.id}"> 
                                            Konsultasi
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                `;
                                $('#searchResults').append(card);
                              });
                            } else {
                              $('#searchResults').html('<div class="col-12"><div class="alert alert-warning">No results found</div></div>');
                            }
                          }
                        });
                } else {
                  $('#searchResults').html('');
                }
              });
  });
</script>
<script>
  $('.btn-konsul').click(function() {
      let id = $(this).data('id'); // Ambil ID dari data-id tombol
      let url = '/profesional/get/' + id; // Buat URL untuk AJAX
      let img = '';
      console.log(id)
      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {  
          $('#name').text(''+response.name);
          $('#notelp').text(''+response.notelp);
          $('#email').text(''+response.email);
          $('#id_worker').val(response.id);
          $('#harga').text('Rp. '+response.harga);
          $('#harga_worker').val(response.harga);
          // img = '/'+response.bukti_bayar; 
          // $('#bukti_pembayaran').attr('src',img);
          // console.log(response)
        }
      });
    });

  $('.btn-inpo').click(function() {
      let id = $(this).data('id'); // Ambil ID dari data-id tombol
      let url = '/profesional/get/' + id; // Buat URL untuk AJAX
      let img = '';
      console.log(id)
      // AJAX request untuk mendapatkan data pembayaran
      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {  
          // console.log(response)
          $('#name2').text(''+response.name);
          $('#notelp2').text(''+response.notelp);
          $('#email2').text(''+response.email); 
          // img = '/'+response.bukti_bayar; 
          // $('#bukti_pembayaran').attr('src',img);
          // console.log(response)
        }
      });
    });
  </script>
  @endsection