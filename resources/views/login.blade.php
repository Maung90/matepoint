<!DOCTYPE html>
<html lang="id">
<head>
  <!--  Title -->
  <title>@yield('title', 'Halaman Login')</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Matepoint" />
  <meta name="author" content="" />
  <meta name="keywords" content="Matepoint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.ico') }}" />
  <!-- Owl Carousel  -->
  <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">

  <!-- Core Css -->
  <link  id="themeColors"  rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />

  <!-- Custom CSS -->

</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
  <div class="position-relative overflow-hidden radial-gradient min-vh-100">
    <div class="position-relative z-index-5">
      <div class="row">
        <div class="col-xl-7 col-xxl-8">
          <span class="text-primary fs-8 fw-bolder  text-nowrap logo-img d-block px-4 py-9 w-100">
           Matepoint
         </span>
         <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
          <img src="{{ asset('assets/images/backgrounds/login-security.svg')}}" alt="" class="img-fluid" width="500">
        </div>
      </div>
      <div class="col-xl-5 col-xxl-4">
        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
          <div class="col-sm-8 col-md-6 col-xl-9">
            <h2 class="mb-3 fs-7 fw-bolder">Welcome to matepoint</h2>
            <p class=" mb-9" style="letter-spacing:0.5px;">Masuk menggunakan akun Matepoint</p> 
            <div class="position-relative text-center my-4">
              <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative"></p>
              <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
            </div>
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" required class="form-control" id="password">
              </div>
                  <div class="d-flex align-items-center justify-content-between mb-4"> 
                    <a class="text-primary fw-medium" href="{{ route('forgot_password') }}">Lupa password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                    Masuk
                  </button>
                  @if($errors->any())
                  <div class="alert alert-danger mt-2">
                    {{ $errors->first() }}
                  </div>
                  @endif
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">Belum punya akun?</p>
                    <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Daftar disini </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
