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
  <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
    <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
      <i class="ti ti-menu-2 fs-5"></i>
    </button>
    <form class="position-relative w-100">
      <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
      <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
    </form>
  </div>
  <div class="d-flex w-100">
    <div class="d-flex w-100">
      <div class="min-width-340">
        <div class="border-end user-chat-box h-100">
          <div class="px-4 pt-9 pb-6 d-none d-lg-block"> 
          </div>
          <div class="app-chat">
            <ul class="chat-users" style="height: calc(100vh - 400px)" data-simplebar>
              @foreach ($users as $talent)
              <li class="btn-chat" data-id="{{$talent->id}}">
                <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user bg-light" id="chat_user_1" >
                  <span class="position-relative">
                    <img src="{{ asset('assets/images/profile/user-4.jpg') }}" alt="user-4" width="40" height="40" class="rounded-circle">
                  </span>
                  <div class="ms-6 d-inline-block w-75">
                    <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">{{$talent->name}} </h6>
                    <span class="fs-2 text-body-color d-block">{{$talent->email}}</span>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Talent Details</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center"> 
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pilih">
                    <button class="text-dark px-2 fs-5 bg-primary border-0 rounded-1 text-white bg-hover-primary nav-icon-hover position-relative z-index-5" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                      <i class="ti ti-arrow-right"></i>
                    </button>
                  </li> 
                </ul>
              </div>
              <div class="position-relative overflow-hidden">
                <div class="position-relative">
                  <div class="chat-box p-9" style="height: calc(100vh - 428px)" data-simplebar>
                    <div class="chat-list chat active-chat" data-user-id="1">
                      <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                          <img src="{{ asset('assets/images/profile/user-4.jpg') }}" alt="user4" width="72" height="72" class="rounded-circle" />
                          <div>
                            <h6 class="fw-semibold fs-4 mb-0" id="name">Dr. Bonnie Barstow </h6> 
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Phone number</p>
                          <h6 class="fw-semibold mb-0" id="notelp">+1 (203) 3458</h6>
                        </div>
                        <div class="col-8 mb-7">
                          <p class="mb-1 fs-2">Email address</p>
                          <h6 class="fw-semibold mb-0" id="email">alexandra@modernize.com</h6>
                        </div>
                        <div class="col-12 mb-9">
                          <p class="mb-1 fs-2">Address</p>
                          <h6 class="fw-semibold mb-0"  id="lokasi">312, Imperical Arc, New western corner</h6>
                        </div> 
                      </div>
                      <div class="border-bottom pb-7 mb-4">
                        <p class="mb-2 fs-2">Review</p>
                        @for($i = 1; $i<=5; $i++) 
                        <div>
                          <div class="d-flex align-items-center gap-3">
                            <img src="{{asset('assets/images/profile/user-'.$i.'.jpg')}}" alt="" class="rounded-circle" width="33" height="33">
                            <h6 class="fw-semibold mb-0 fs-4">Deran Mac</h6>
                            <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> 8 min ago</span>
                          </div>
                          <div class="d-flex align-items-center my-3">
                            <div class="d-flex align-items-center gap-2">
                              <span class="text-warning d-flex align-items-center justify-content-center">
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                              </span> 
                            </div> 
                          </div>
                          <p>Lufo zizrap iwofapsuk pusar luc jodawbac zi op uvezojroj duwage vuhzoc ja vawdud le furhez siva 
                            fikavu ineloh. Zot afokoge si mucuve hoikpaf adzuk zileuda falohfek zoije fuka udune lub annajor gazo conis sufur gu.
                          </p> 
                        </div>
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Contact </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="px-9 pt-4 pb-3">
          <button class="btn btn-primary fw-semibold py-8 w-100">Add New Contact</button>
        </div>
        <ul class="list-group" style="height: calc(100vh - 150px)" data-simplebar>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-inbox fs-5"></i>All Contacts 
            </a>
          </li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-star"></i>Starred 
            </a>
          </li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-file-text fs-5"></i>Pening Approval 
            </a>
          </li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-alert-circle"></i>Blocked 
            </a>
          </li>
          <li class="border-bottom my-3"></li>
          <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">CATEGORIES</li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-bookmark fs-5 text-primary"></i>Engineers 
            </a>
          </li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-bookmark fs-5 text-warning"></i>Support Staff 
            </a>
          </li>
          <li class="list-group-item border-0 p-0 mx-9">
            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
              <i class="ti ti-bookmark fs-5 text-success"></i>Sales Team 
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="bs-example-modal-md" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <form action="{{ route('talent.store') }}" method="POST" id="updateForm">
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
          <h5 class="text-dark" id="harga">Rp. 80.000</h5>
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

<script>
  $('.btn-chat').click(function() {
      let id = $(this).data('id'); // Ambil ID dari data-id tombol
      let url = '/talent/get/' + id; // Buat URL untuk AJAX
      let img = '';
      // console.log(id)
      // AJAX request untuk mendapatkan data pembayaran
      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {  
          // console.log(response)
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
  </script>
  @endsection