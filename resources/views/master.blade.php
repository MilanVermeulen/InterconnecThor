<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>iThor</title>
	{{-- bootstrap css --}}
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  {{-- google fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	{{-- custom css --}}
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">

	{{-- navbar --}}
	<nav class="navbar navbar-expand-lg bg-body-tertiary" style="min-height: 10vh">
		<div class="container-fluid">
			<a class="navbar-brand text-primary" href="/">iThor</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
          {{-- routes --}}
					<li class="nav-item"><a class="{{Request::path() === '/' ? 'nav-link active active' : 'nav-link' }}" href="/">Home</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'faq' ? 'nav-link active active' : 'nav-link' }}" href="/faq">FAQ</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'about' ? 'nav-link active active' : 'nav-link' }}" href="/about">About us</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'contact' ? 'nav-link active active' : 'nav-link' }}" href="/contact">Contact us</a></li>
					<li class="nav-item"><a class="{{Request::path() === 'chatify' ? 'nav-link active active' : 'nav-link' }}" href="/chatify">Messenger</a></li>
					
          {{-- dropdown menu when logged in --}}
          @auth('student')
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Your profile</a></li>
								<li><a class="dropdown-item" href="#">Settings</a></li>
								<li><a class="dropdown-item" href="#">Privacy</a></li>
							</ul>
						</li>
					@endauth

					{{-- search name/city --}}
					<form class="d-flex mb-1" action="/search" method="GET">
						@csrf
						<input class="form-control me-2" type="search" name="search" placeholder="Search" required minlength="3">
						<button class="btn btn-outline-primary me-2 mb-1" type="submit">Search</button>
					</form>
				</ul>

				{{-- registration,login and logout --}}
				@auth('student')
					<form action="{{ route('logout') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-outline-primary me-2 mb-1">Logout</button>
					</form>
				@else
					<a class="nav-link" href="/login"><button class="btn btn-outline-primary me-2 mb-1">Log in</button></a>
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
	<div class="container-fluid bg-light">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<p class="text-center p-5">© {{ date('Y') }} Incognito's</p>
			</div>
		</div>
	</div>
  
</body>
	{{-- bootstrap js --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>