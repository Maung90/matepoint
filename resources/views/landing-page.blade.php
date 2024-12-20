<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--  Title -->
	<title>Matepoint</title>
	<!--  Favicon -->
	<link rel="shortcut icon" type="image/png" href="{{asset('dist/images/logos/favicon.ico') }}">
	<!--  Aos -->
	<link rel="stylesheet" href="{{ asset('dist/libs/aos/dist/aos.css') }}">
	<link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
</head>

<body>
	<div class="page-wrapper p-0 overflow-hidden">
		<header class="header">
			<nav class="navbar navbar-expand-lg py-0">
				<div class="container">
					<a class="navbar-brand me-0 py-0" href="/"> 
						<span class="text-primary fs-8 fw-bold">
							Matepoint
						</span>
					</a>
					<button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="ti ti-menu-2 fs-9"></i>
					</button>
					<button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<i class="ti ti-menu-2 fs-9"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav align-items-center mb-2 mb-lg-0 ms-auto"> 
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/daftar">Daftar</a>
							</li>
							<li class="nav-item ms-2">
								<span>|</span>
							</li>
							<li class="nav-item ms-2">
								<a class="nav-link active" href="/login"> Login</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="body-wrapper overflow-hidden">
			<section class="hero-section position-relative overflow-hidden mb-0 mb-lg-11">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-xl-6 p-4">
							<div class="hero-content my-11 my-xl-0">
								<h6 class="d-flex align-items-center gap-2 fs-4 fw-semibold mb-3" data-aos="fade-up"data-aos-delay="200" data-aos-duration="1000">
									<i class="ti ti-rocket text-secondary fs-6"></i>
									Konsultasi Tepat, Solusi Cepat
								</h6>
								<h1 class="fw-bolder mb-8 fs-13" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
									Konsultasi dengan  
									<span class="text-primary"> Talent & Konsultan</span>
									kami yang berpengalaman.
								</h1> 
								<div class="d-sm-flex align-items-center gap-3 mb-4" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
									<a class="btn btn-primary btn-hover-shadow d-block mb-3 mb-sm-0 scroll-link" href="/login">Login</a>
									<a class="btn btn-outline-primary d-block scroll-link" href="/daftar">Mulai</a>
								</div>
								<div class="d-sm-flex align-items-center gap-3 mb-4" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="1000">
									<div class="border border-dashed px-3 py-2 rounded text-center text-sm-start mb-3 mb-sm-0">
										<h5 class="mb-1 fw-bolder">10+</h5>
										<p class="mb-0">Talent</p>
									</div>
									<div class="border border-dashed px-3 py-2 rounded text-center text-sm-start mb-3 mb-sm-0">
										<h5 class="mb-1 fw-bolder">20+</h5>
										<p class="mb-0">Konsultan</p>
									</div> 
								</div>
							</div>
						</div>
						<div class="col-xl-6 d-none d-xl-block">
							<img src="{{asset('dist\images\illustrations\girl-sitting-with-laptop.png')}}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
			</section>

			<section class="features-section py-5 bg-primary">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000"> 
								<h2 class="fs-7 text-center mb-4 mb-lg-9 fw-bolder">
									Apapun Masalahnya, <span class="text-white">Matepoint</span> Solusinya
									<br>
									Mau curhat soal apa saja bisa, kami siapkan ahlinya
								</h2>
							</div>
						</div>
					</div>
					<div class="demo-app-tabs ">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-bootstrap-features" role="tabpanel" aria-labelledby="nav-bootstrap-features-tab" tabindex="0">
								<div class="row">
									<div class="col-lg-3" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
									</div>
									<div class="col-lg-3" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
										<div class="text-center mb-5">
											<i class="d-block ti ti-school text-white fs-13"></i> 
											<p class="mb-0 text-white">Profesional</p>
										</div>
									</div>
									<div class="col-lg-3" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
										<div class="text-center mb-5">
											<i class="d-block ti ti-stars text-white fs-13"></i> 
											<p class="mb-0 text-white">Talent</p>
										</div>
									</div>
									<div class="col-lg-3" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
									</div>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</section> 
			<section class=" pt-5 pt-xl-9 pb-8">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-7 col-xl-5 pt-lg-5 mb-5 mb-lg-0 d-flex align-items-center justify-content-center">
							<h2 class="fs-12 text-primary text-center text-lg-start fw-bolder mb-8"> 
								Konsultasikan permasalahan Anda dan temukan jawaban dari para talent dan konsultan terkemuka.
							</h2> 
						</div>
						<div class="col-lg-5 col-xl-5">
							<div class="text-center text-lg-end">
								<img src="{{ asset('dist/images/backgrounds/business-woman-checking-her-mail.png') }}" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</section>
		</div> 
		<div class="offcanvas offcanvas-start modernize-lp-offcanvas" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
			<div class="offcanvas-header p-4"> 
				<span class="text-primary fs-8 fw-bold">
					Matepoint
				</span>
			</div>
			<div class="offcanvas-body p-4">
				<ul class="navbar-nav justify-content-end flex-grow-1"> 
					<li class="nav-item mt-3">
						<a class="nav-link fs-3 text-dark" aria-current="page" href="/">Home</a>
					</li>
					<li class="nav-item mt-3">
						<a class="nav-link fs-3 text-dark" href="/daftar">Daftar</a>
					</li>
					<li class="nav-item mt-3">
						<a class="nav-link fs-3 text-dark" href="/login">Login</a>
					</li>
				</ul> 
			</div>
		</div>
	</div>
	<script src="{{asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{asset('dist/libs/aos/dist/aos.js') }}"></script>
	<script src="{{asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{asset('dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
	<script src="{{asset('dist/js/custom.js') }}"></script> 
</body>

</html>
