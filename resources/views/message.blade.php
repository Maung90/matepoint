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
      <div class="app-chat">
        <ul class="chat-users" style="height: calc(100vh - 496px)" data-simplebar>
          <?php $i = 0; ?>
          @foreach ($list as $item)
          <?php $i++; ?>
          <li>
              <span class="px-4 py-3 cursor-pointer bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_{{ $i }}" data-id="{{ $item->uuid }}">
                  <div class="d-flex align-items-center">
                      <span class="position-relative">
                          <img src="{{ asset('assets/images/profile/user-'.$i.'.jpg') }}" alt="user{{ $i }}" width="48" height="48" class="rounded-circle" />
                          <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
                              <span class="visually-hidden">New alerts</span>
                          </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                            <h6 class="fw-semibold chat-title" data-username="{{ $item->pembayaran->customer->name }}">
                                {{ $item->pembayaran->customer->name }}
                            </h6>
                            @if($item->pembayaran->worker->role_id == 3)
                              <span class="badge text-bg-primary" id="countdown-expired" data-expired="{{ $item->expired_at }}" data-username="{{ $item->pembayaran->worker->name }}"></span>
                            @endif
                        @else
                            <h6 class="fw-semibold chat-title" data-username="{{ $item->pembayaran->worker->name }}">
                                {{ $item->pembayaran->worker->name }}
                            </h6>
                            @if($item->pembayaran->worker->role_id == 3)
                              <span class="badge text-bg-primary" id="countdown-expired" data-expired="{{ $item->expired_at }}" data-username="{{ $item->pembayaran->worker->name }}"></span>
                            @elseif($item->pembayaran->worker->role_id == 2)
                              <span class="badge text-bg-primary">Profesional</span>
                            @endif
                        @endif
                      </div>
                  </div>
                  <p class="mb-0 fs-2 text-muted" data-transaksi="{{ $item->pembayaran->kode_transaksi }}">{{ $item->pembayaran->kode_pembayaran }}</p>
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
        <div class="p-2 botder-top border-bottom chat-meta-user d-flex align-items-center justify-content-end">
          <ul class="mb-0 list-unstyled d-flex align-items-center">
            <li>
              <span id="end-session" class="px-2 cursor-pointer chat-menu text-dark fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5">
                <i class="ti ti-message-circle-off"></i>
              </span>
              <span id="refresh-chat" class="px-2 cursor-pointer chat-menu text-dark fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5">
                <i class="ti ti-refresh"></i>
              </span>
            </li>
          </ul>
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
                  <input type="text" class="p-0 border-0 form-control message-type-box text-muted ms-2" id="text-message" placeholder="Type a Message" />
                </div>
                <ul class="mb-0 list-unstyledn d-flex align-items-center">
                  <input type="hidden" id="uuid_sharing" value="{{ isset($id) ? $id : '' }}">
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
    <div class="app-chat">
      <ul class="chat-users" style="height: calc(100vh - 200px)" data-simplebar>
        <?php $i = 0; ?>
        @foreach ($list as $item)
        <?php $i++; ?>
        <li>
            <span class="px-4 py-3 cursor-pointer bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_{{ $i }}" data-id="{{ $item->uuid }}">
                <div class="d-flex align-items-center">
                    <span class="position-relative">
                        <img src="{{ asset('assets/images/profile/user-'.$i.'.jpg') }}" alt="user{{ $i }}" width="48" height="48" class="rounded-circle" />
                        <span class="bottom-0 p-1 position-absolute end-0 badge rounded-pill bg-success">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </span>
                    <div class="ms-3 d-inline-block w-75">
                        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                            <h6 class="fw-semibold chat-title" data-username="{{ $item->pembayaran->customer->name }}">
                                {{ $item->pembayaran->customer->name }}
                            </h6>
                            @if($item->pembayaran->worker->role_id == 3)
                              <span class="badge text-bg-primary" id="countdown-expired" data-expired="{{ $item->expired_at }}" data-username="{{ $item->pembayaran->worker->name }}"></span>
                            @endif
                        @else
                            <h6 class="fw-semibold chat-title" data-username="{{ $item->pembayaran->worker->name }}">
                                {{ $item->pembayaran->worker->name }}
                            </h6>
                            @if($item->pembayaran->worker->role_id == 3)
                              <span class="badge text-bg-primary" id="countdown-expired" data-expired="{{ $item->expired_at }}" data-username="{{ $item->pembayaran->worker->name }}"></span>
                            @elseif($item->pembayaran->worker->role_id == 2)
                              <span class="badge text-bg-primary">Profesional</span>
                            @endif
                        @endif
                    </div>
                </div>
                <p class="mb-0 fs-2 text-muted" data-transaksi="{{ $item->pembayaran->kode_transaksi }}">{{ $item->pembayaran->kode_pembayaran }}</p>
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
      const loadMessages = (id) => {
          $.ajax({
              url: `{{ route("message.detail", ":id") }}`.replace(':id', id),
              type: 'GET',
              success: (response) => $('#display_message').html(response),
              error: (xhr) => {
                  let msg = xhr.responseJSON?.message || 'Terjadi kesalahan.';
                  toastr.error('Gagal memuat detail pesan. Error: ' + msg);
              }
          });
      };

      $('.chat-user').click(function() {
          let id = $(this).data('id');
          $('#uuid_sharing').val(id);
          loadMessages(id);
      });

      $('#send-message').click(function() {
          let uuid_sharing = $('#uuid_sharing').val();
          let body = $('#text-message').val();

          $.ajax({
              url: `{{ route("message.create", ":id") }}`.replace(':id', uuid_sharing),
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}',
                  body: body
              },
              success: () => {
                  $('#text-message').val('');
                  loadMessages(uuid_sharing);
              },
              error: (xhr) => {
                  let msg = xhr.responseJSON?.message || 'Terjadi kesalahan.';
                  toastr.error('Gagal mengirim pesan. Error: ' + msg);
              }
          });
      });

      const countdown = () => {
          $('.badge#countdown-expired').each(function() {
              let expired = $(this).data('expired');
              let now = Math.floor(Date.now() / 1000);
              let remainingTime = expired - now;

              if (remainingTime > 0) {
                  let hours = Math.floor(remainingTime / 3600);
                  let minutes = Math.floor((remainingTime % 3600) / 60);
                  let seconds = remainingTime % 60;
                  
                  $(this).text(`${hours} : ${minutes} : ${seconds}`);
                } else {
                  $(this).removeClass('text-bg-primary');
                  $(this).addClass('text-bg-danger');
                  $(this).text(`Sesi Berakhir`);
              }
          });
      };
      
      setInterval(countdown, 1000);
      countdown();

      $('#refresh-chat').click(function() {
        let id = $('#uuid_sharing').val();
        if (id) {
          loadMessages(id);
        } else {
          toastr.error('Silahkan pilih pesan terlebih dahulu.');
        }
      });

      $('#end-session').click(function() {
          let id = $('#uuid_sharing').val();
          if (id) {
              Swal.fire({
                  title: "Are you sure?",
                  text: "You won't be able to revert this!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Yes!",
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                      url: '{{ route("message.end_session", ":id") }}'.replace(':id', id),
                      type: 'PUT',
                      data: {
                          "_token": "{{ csrf_token() }}"  // Sertakan CSRF token untuk keamanan
                      },
                      success: function(response) {
                          Swal.fire({
                              title: "Success!",
                              text: response.message,
                              icon: "success",
                              confirmButtonText: "OK"
                          }).then(() => {
                              location.reload();  
                          });
                      },
                      error: function(response) {
                          Swal.fire({
                              title: "Error!",
                              text: response.responseJSON.message || "An error occurred",
                              icon: "error",
                              confirmButtonText: "OK"
                          });
                      }
                  });
                }
              });
          } else {
            toastr.error('Silahkan pilih pesan terlebih dahulu.');
          }
      });
  });
  
  @if(isset($id))
    $(document).ready(function() {
        let id = '{{ $id }}';
        $.ajax({
            url: '{{ route("message.detail", ":id") }}'.replace(':id', id),
            type: 'GET',
            success: function(response) { 
                $('#uuid_sharing').val(id);
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