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
    <style>
        /* Style untuk memastikan halaman login center dan responsif */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Membuat warna background putih transparan */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            z-index: 2; /* Supaya elemen ini berada di atas background */
        }

        .background-image {
            background-image: url('C:/Users/User/Documents/sepri/vuexy-bootstrap-html-admin-template/assets/img/illustrations/girl-sitting-with-laptop.png');
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1; /* Supaya gambar background berada di bawah kotak login */
            opacity: 0.6; /* Membuat gambar transparan agar tidak terlalu mencolok */
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
        .btn-block {
            width: 100%;
        }
        .text-center p {
            margin: 0.5rem 0;
        }
        /* Media query untuk layar kecil */
        @media (max-width: 576px) {
            .login-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-image"></div> <!-- Background gambar -->

    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            @if($errors->any())
                <div class="alert alert-danger mt-2">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
        <div class="mt-3 text-center">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>
