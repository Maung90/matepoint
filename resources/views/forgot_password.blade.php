<!DOCTYPE html>
<html lang="en">
<head>
  <!--  Title -->
  <title>Mordenize</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Mordenize" />
  <meta name="author" content="" />
  <meta name="keywords" content="Mordenize" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logos/favicon.ico')}}" />
  
  <!-- Core Css -->
  <link  id="themeColors"  rel="stylesheet" href="{{asset('assets/css/style.min.css')}}" />
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="{{asset('assets/images/logos/favicon.ico')}}" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!-- Preloader -->
  <div class="preloader">
    <img src="{{asset('assets/images/logos/favicon.ico')}}" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-lg-6 col-xl-8 col-xxl-9">
            <a href="/" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <span class="text-primary fs-8 fw-bolder  text-nowrap logo-img d-block px-4 py-9 w-100">
                Matepoint
              </span>
            </a>
            <div class="d-none d-lg-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
              <img src="{{asset('assets/images/backgrounds/login-security.svg')}}" alt="" class="img-fluid" width="500">
            </div>
          </div>
          <div class="col-lg-6 col-xl-4 col-xxl-3">
            <div class="card mb-0 shadow-none rounded-0 min-vh-100 h-100">
              <div class="d-flex align-items-center w-100 h-100">
                <div class="card-body">
                  <div class="mb-5">
                    <h2 class="fw-bolder fs-7 mb-3">Lupa password kamu?</h2>
                    <p class="mb-0 ">   
                      Masukan alamat email kamu yang terhubung dengan akun dan Kami akan mengirimkan email untuk mengubah password kamu             
                    </p>
                  </div>
                  <form>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button class="btn btn-primary w-100 py-8 mb-3">Kirim Email</button>
                    <a href="{{route('login')}}" class="btn btn-light-primary text-primary w-100 py-8">Kembali ke Login</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <!--  Import Js Files -->
  <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--  core files -->
  <script src="{{asset('assets/js/app.min.js')}}"></script>
  <script src="{{asset('assets/js/app.init.js')}}"></script>
  <script src="{{asset('assets/js/app-style-switcher.js')}}"></script>
  <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>

  <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>