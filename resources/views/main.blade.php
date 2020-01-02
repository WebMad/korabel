<!DOCTYPE html>
<html>
<head>
	<title>{{ isset($site_infos['site_name']) ? $site_infos['site_name'] : '' }}  - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="yandex-verification" content="49ba18a912016474" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/landing/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/messages.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/inputs.css') }}">
	<link rel="shortcut icon" href="{{ asset('images/house-icon.png') }}" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	@yield('head')
</head>
<body>
<header>
	<a href="{{ route('landing') }}" class="logo">
		<div class="logo-text">{{ isset($site_infos['site_name']) ? $site_infos['site_name'] : '' }}</div>
		<div class="logo-desc">{{ isset($site_infos['site_subname']) ? $site_infos['site_subname'] : '' }}</div>
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
		<div class="auth-header">
			<a href="{{ route('login') }}">Войти</a>
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

@extends('landing.footer')

@yield('scripts_end')

</body>
</html>