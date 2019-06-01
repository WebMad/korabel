<!DOCTYPE html>
<html>
<head>
	<title>СНТ КОРАБЕЛ - @yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/landing/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/messages.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/inputs.css') }}">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	@yield('head')
</head>
<body>
<header>
	<a href="{{ route('landing') }}" class="logo">
		<div class="logo-text">{{ \App\Http\Controllers\InfoController::getInfo()['site_name'] }}</div>
		<div class="logo-desc">{{ \App\Http\Controllers\InfoController::getInfo()['site_subname'] }}</div>
	</a>
	<div class="menu">
		<a href="{{ route('landing') }}" class="element">Главная</a>
		<a href="{{ route('news') }}" class="element">Новости</a>
		<a href="{{ route('documents') }}" class="element">Документы</a>
		<a href="{{ route('contacts') }}" class="element">Контакты</a>
		@auth
			<a href="{{ route('cabinet.index') }}" class="element">Кабинет</a>
		@endif
		<!--<div class="element">Объявления</div>-->
		@yield('menu')
	</div>
	@guest
		<div class="contacts">
			<div class="phone-icon"></div>
			<div class="phone">{{ \App\Http\Controllers\InfoController::getInfo()['site_phone'] }}</div>
		</div>
	@else
		<div class="user_sb">
			<a href="{{ route('cabinet.index') }}" class="name_user_sb">{{ Auth::user()->name }}</a>
			<a class="exit-icon" href="{{ route('logout') }}"
			   onclick="event.preventDefault();
			   document.getElementById('logout-form').submit();">
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
	@endif
</header>
<div class="content">
	@yield('content')
</div>

@yield('footer')

@yield('scripts_end')

</body>
</html>