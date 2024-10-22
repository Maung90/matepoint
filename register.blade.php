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
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />
  </head>
<body>
    <div class="container mt-5">
        <h2>Registrasi</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="notelp">No Telepon:</label>
                <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Masukkan no telepon" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
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
        </form>
        <div class="mt-3 text-center">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
        </div>
    </div>
</body>
</html>
