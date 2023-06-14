<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>iThor</title>
	<!-- Tailwindcss styles -->
	{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" referrerpolicy="no-referrer" /> --}}
	{{-- bootstrap css --}}
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	{{-- google fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.bg-custom {
		background-color: #2BA2C5;
		}
	</style>
	{{-- vite --}}
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	{{-- custom css --}}
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-dark antialiased">

	{{-- navbar --}}
	<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark" style="min-height: 10vh">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">
				<img src="{{ asset('/assets/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 6vh"><span class="text-light fw-bold ms-2">i</span><span class="text-primary">nterconnec</span><span class="text-light fw-bold">T</span><span class="text-primary">hor</span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
					{{-- routes --}}
					<li class="nav-item"><a class="{{Request::path() === '/' ? 'nav-link active active' : 'nav-link' }}" href="/"><i class="fa-solid fa-house"></i></a></li>
					<li class="nav-item"><a class="{{Request::path() === 'faq' ? 'nav-link active active' : 'nav-link' }}" href="/faq">FAQ</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'about' ? 'nav-link active active' : 'nav-link' }}" href="/about">About Us</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'contact' ? 'nav-link active active' : 'nav-link' }}" href="/contact">Contact Us</a></li>

					{{-- search name/city --}}
					<form class="d-flex mb-1" action="/search" method="GET">
						@csrf
						<input class="form-control me-2" type="search" name="search" placeholder="Search for students" required minlength="3">
						<button class="btn btn-outline-primary me-2 mb-1" type="submit">Search</button>
					</form>
				</ul>

				{{-- registration, login, and logout/profile pic/dropdown menu --}}
				@auth
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-light me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href={{ route('profile') }}>Your profile</a></li>
							<li><a class="dropdown-item" href="/chat">Chat</a></li>
							<li><a class="dropdown-item" href="/meet">Meet</a></li>
							<li><a class="dropdown-item" href="#">Settings & Privacy</a></li>
						</ul>
					</div>

					<form action="{{ route('logout') }}" method="POST">
						@csrf
						@if (Auth::check())
							<img src="{{ asset('storage/' . (Auth::user()->profile_picture ?: 'profile-pictures/default.jpg')) }}" alt="Profile Picture" class="img-fluid rounded-pill mb-2 border border-light border-2 me-2 mt-1" style="max-height: 5vh; width: auto;">
							<button type="submit" class="btn btn-primary me-2 mb-1 mt-1">Logout</button>
						@endif
					</form>
				@else
					<a class="nav-link" href="/login"><button class="btn btn-primary me-2 mb-1">Log in</button></a>
					<a class="nav-link" href="/register"><button class="btn btn-outline-primary me-2 mb-1">Sign up</button></a>
				@endauth

			</div>
		</div>
	</nav>

	{{-- content --}}
	<div class="container-fluid" style="min-height: 90vh">
		@yield('content')
	</div>

	{{-- footer --}}
	<div class="container-fluid text-light mt-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<p class="text-center p-5">© {{ date('Y') }} Incognito's</p>
			</div>
		</div>
	</div>

</body>

	<!-- lodash cdn link -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	{{-- bootstrap js --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	@stack('scripts')

</html>
