<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
</head>
<body style="color:{{ $page->color_text }}; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url({{ $page->background }});">
	<nav class="navbar sticky-top navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="">Turibus</a>
			<ul class="nav mr-auto align-items-center">
				<li class="nav-item">
					<a class="nav-link" href="#map">Ubicación</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn btn-sm btn-success p-1" href="#ticket">Comprar ticket</a>
				</li>
			</ul>
		</div>
	</nav>
		
	<div class="container">
		<div class="row mt-3">
			<div class="col-12">
				<div class="card rounded" style="background-color: rgba(255, 255,255, 0.9)">
					<div class="card-body">
						<h1 class="text-center">{{ $page->event->title }}</h1>
						<p class="text-justify">{{ $page->event->description }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-12">
				<div class="card rounded" style="background-color: rgba(255, 255,255, 0.9)">
					<div class="card-body">
						<p>{{ $page->event->location }}</p>
						<p>{{ $page->event->start_date }}</p>
						<p>{{ $page->event->end_date }}</p>
						<p>{{ $page->event->event_type->name }}</p>
						<hr>

						<div class="mt-3 text-center" id="map">
							<img class="img-fluid" style="max-height: 350px" src="{{ asset('img/map_event.jpg') }}">
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>