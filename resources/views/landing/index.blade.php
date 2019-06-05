@extends('main')

@section('title', 'Главная')

@section('content')
	<div class="main-slider">
		<div class="container">
			<div class="advantages">
				<div class="advantage">
					<div class="header_advantage">Удобно</div>
					<div class="text_advantage">Используйте этот интернет-портал, чтобы получать информацию о сообществе в кратчайшие сроки. Новости, квитанции, документы, контакты - все это доступно в одном месте!</div>
				</div>
				<div class="advantage">
					<div class="header_advantage">Безопасность</div>
					<div class="text_advantage">Ваша информация надежно защищена, мы заботимся об этом. Используя данный интернет-портал, вы можете не беспокоиться о том, что информация попадет в третьи руки.</div>
				</div>
				<div class="advantage">
					<div class="header_advantage">Скорость</div>
					<div class="text_advantage">Данный интернет-портал позволяет затрачивать меньшее количество времени на электронный документооборот.</div>
				</div>
			</div>
			@if(Auth::id() == null)
				<div class="auth">
					<div class="auth_header">Вход в личный кабинет</div>
					<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="form-group">
							@if($errors->has('email'))
								<div class="msg-wrong-input">{{ $errors->first('email') }}</div>
							@endif
							<input type="text" name="email" placeholder="Электронная почта">
						</div>

						<div class="form-group">
							<span><a href="{{ route('password.request') }}">Забыли пароль?</a></span>
							<input type="password" name="password" placeholder="Пароль">
						</div>
						<div class="row"><input type="submit" value="Вход"> <a href="{{ route('register') }}">Регистрация</a></div>
					</form>
				</div>
			@endif
		</div>
	</div>
@endsection

@section('scripts_end')
	<!--slick.js-->
	<link rel="stylesheet" type="text/css" href="{{ asset('js/slick/slick.css') }}"/>
	<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>
	<!--end slick.js-->

	<!--my js-->
	<script type="text/javascript" src="{{ asset('js/landing/script.js') }}"></script>
	<!-- end -->
@endsection