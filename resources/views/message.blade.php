<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Matepoint - Chat')

@section('content') 
<!-- content -->
<div class="overflow-hidden shadow-none card bg-light-info position-relative">
  <div class="px-4 py-3 card-body">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="mb-8 fw-semibold">Chat Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted " href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Chats</li>
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
<div class="overflow-hidden card chat-application">
  <div class="gap-3 m-3 d-flex align-items-center justify-content-between d-lg-none">
    <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
      <i class="ti ti-menu-2 fs-5"></i>
    </button>
    <form class="position-relative w-100">
      <input type="text" class="py-2 form-control search-chat ps-5" id="text-srh" placeholder="Search Contact">
      <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
    </form>
  </div>
  <div class="d-flex">
    <div class="w-30 d-none d-lg-block border-end user-chat-box">
      <div class="px-4 pb-6 pt-9">
        <div class="pb-3 d-flex align-items-center justify-content-between border-bottom">
          <div class="d-flex align-items-center">
            <div class="position-relative">
              <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="user1" width="54" height="54" class="rounded-circle">
              <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
                <span class="visually-hidden">New alerts</span>
              </span>
            </div>
            <div class="ms-3">
              <h6 class="mb-2 fw-semibold">{{ auth()->user()->name }}</h6> 
            </div>
          </div> 
        </div>
      </div>
      <div class="app-chat">
        <ul class="chat-users" style="height: calc(100vh - 496px)" data-simplebar>
            <?php $i = 0; ?>
            @foreach ($list as $item)
            <?php $i++; ?>
            <li>
                <span class="px-4 py-3 cursor-pointer bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_{{ $i }}" data-id="{{ $item->customer->id }}">
                    <div class="d-flex align-items-center">
                        <span class="position-relative">
                            <img src="{{ asset('assets/images/profile/user-'.$i.'.jpg') }}" alt="user{{ $i }}" width="48" height="48" class="rounded-circle" />
                            <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </span>
                        <div class="ms-3 d-inline-block w-75">
                            <h6 class="fw-semibold chat-title" data-username="{{ $item->customer->name }}">{{ $item->customer->name }}</h6>
                        </div>
                    </div>
                </span>
            </li> 
            @endforeach
        </ul>      
      </div>
    </div>
    <div class="w-70 w-xs-100 chat-container">
      <div class="chat-box-inner-part h-100">
        <div class="chat-not-selected h-100 d-none">
          <div class="p-5 d-flex align-items-center justify-content-center h-100">
            <div class="text-center">
              <span class="text-primary">
                <i class="ti ti-message-dots fs-10"></i>
              </span>
              <h6 class="mt-2">Open chat from the list</h6>
            </div>
          </div>
        </div>
        
        <div class="overflow-hidden position-relative d-flex">
          <div class="position-relative d-flex flex-grow-1 flex-column">
            <div class="chat-box p-9" style="height: calc(100vh - 442px)" data-simplebar>
              <div class="chat-list chat active-chat" id="display_message">
                
              </div>
            </div>
            <div class="py-6 px-9 border-top chat-send-message-footer">
              <div class="d-flex align-items-center justify-content-between">
                <div class="gap-2 d-flex align-items-center w-85">
                  <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)"> <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i></a>
                  <input type="text" class="p-0 border-0 form-control message-type-box text-muted ms-2" id="text-message" placeholder="Type a Message" />
                </div>
                <ul class="mb-0 list-unstyledn d-flex align-items-center">
                  <input type="hidden" id="id_penerima" value="{{ isset($id) ? $id : '' }}">
                  <li id="send-message"><a class="px-2 text-dark fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-send"></i></a></li>
                </ul>
              </div>
            </div>
          </div>                     
        </div>
      </div>
    </div>
  </div>
  <div class="offcanvas offcanvas-start user-chat-box chat-offcanvas" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Chats </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="px-4 pb-6 pt-9">
      <div class="mb-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <div class="position-relative">
            <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="user1" width="54" height="54" class="rounded-circle">
            <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
            </span>
          </div>
          <div class="ms-3">
            <h6 class="mb-2 fw-semibold">{{ auth()->user()->name }}</h6> 
          </div>
        </div> 
      </div>  
    </div>
    <div class="app-chat">
      <ul class="chat-users" style="height: calc(100vh - 200px)" data-simplebar>
        <?php $i = 0; ?>
        @foreach ($list as $item)
        <?php $i++; ?>
        <li>
          <span class="px-4 py-3 cursor-pointer bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_1" data-id="{{$item->id}}">
            <div class="d-flex align-items-center">
              <span class="position-relative">
                <img src="{{ asset('assets/images/profile/user-'.$i.'.jpg') }}" alt="user1" width="48" height="48" class="rounded-circle" />
                <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
                  <span class="visually-hidden">New alerts</span>
                </span>
              </span>
              <div class="ms-3 d-inline-block w-75">
                <h6 class="fw-semibold chat-title" data-username="{{ $item->name }}">{{ $item->name }}</h6>
              </div>
            </div>
          </span>
        </li> 
        @endforeach
      </ul>
    </div>
  </div>
</div>
</div>
<!-- content -->
@endsection
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

  
    $(document).ready(function() {
        $('.chat-user').click(function() {
            let id = $(this).data('id');
            
            $.ajax({
              url: '{{ route("message.detail", ":id") }}'.replace(':id', id),
              type: 'GET',
              success: function(response) { 
                  $('#id_penerima').val(id);
                  $('#display_message').html(response);
              },
              error: function(xhr, status, error) {
                let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan.';
                toastr.error('Gagal memuat detail pesan. Error: ' + msg);
              }
            });
        });
        
        $('#send-message').click(function() {
            let id_penerima = $('#id_penerima').val();
            let body = $('#text-message').val();
            
            $.ajax({
                url: '{{ route("message.create", ":id") }}'.replace(':id', id_penerima),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    body: body
                },
                success: function(response) {
                    $('#text-message').val('');
                    
                    $.ajax({
                        url: '{{ route("message.detail", ":id") }}'.replace(':id', id_penerima),
                        type: 'GET',
                        success: function(response) { 
                            $('#display_message').html(response);
                        },
                        error: function(xhr, status, error) {
                          let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan.';
                          toastr.error('Gagal memuat detail pesan setelah mengirim. Error: ' + msg);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan.';
                    toastr.error('Gagal mengirim pesan. Error: ' + msg);
                }
            });
        });
    });
    
    @if(isset($id))
      $(document).ready(function() {
          let id = '{{ $id }}';
          $.ajax({
              url: '{{ route("message.detail", ":id") }}'.replace(':id', id),
              type: 'GET',
              success: function(response) { 
                  $('#id_penerima').val(id);
                  $('#display_message').html(response);
              },
              error: function(xhr, status, error) {
                let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan.';
                toastr.error(msg);
              }
          });
      });
    @endif
</script>


@endsection