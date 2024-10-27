<!DOCTYPE html>
<html lang="id">
<head>
    <!--  Title -->
    <title>@yield('title', 'Halaman Daftar')</title>
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
    <link  id="themeColors"  rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />

</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <span class="text-primary fs-8 fw-bolder  text-nowrap logo-img d-block px-4 py-9 w-100">
                            Matepoint
                        </span>
                        <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                            <img src="{{asset('assets/images/backgrounds/login-security.svg')}}" alt="" class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-11">
                                <h2 class="mb-3 fs-7 fw-bolder">Welcome to Modernize</h2>
                                <p class=" mb-9">Daftar akun disini</p> 
                                <div class="position-relative text-center my-4">
                                    <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative"> </p>
                                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12"> 
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                                <input required type="text" class="form-control" name="name" id="exampleInputtext" placeholder="masukan nama" aria-describedby="textHelp">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                <input required type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="masukan email" aria-describedby="emailHelp">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">No Telp</label>
                                                <input required type="text" minlength="1" maxlength="15" class="form-control" id="exampleInputEmail1" placeholder="masukan no telpon" aria-describedby="emailHelp" name="notelp">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                                <input required type="password" class="form-control" id="exampleInputEmail1" placeholder="masukan password" aria-describedby="exampleInputPassword1" name="password">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
                                                <input required type="password" class="form-control" id="exampleInputEmail1" placeholder="masukan konfirmasi password" aria-describedby="exampleInputPassword1" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="col-12"> 
                                            <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Daftar</button>
                                            @if($errors->any())
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first() }}
                                            </div>
                                            @endif
                                            @if(session('success'))
                                            <div class="alert alert-success mt-2">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            <div class="d-flex align-items-center">
                                                <p class="fs-4 mb-0 text-dark">Sudah punya akun?</p>
                                                <a class="text-primary fw-medium ms-2" href="{{route('login')}}">Login disini </a>
                                            </div>
                                        </div>
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
