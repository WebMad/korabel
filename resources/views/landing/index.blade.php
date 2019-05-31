@extends('main')

@section('title', 'Главная')

@section('content')
	<div class="main-slider">
		<div class="container">
			<div class="news">
				@foreach($news as $new)
					<a href="{{ route('news', ['id'=>$new['id']]) }}" class="new">
						<div class="header_new">{{ $new['header'] }}</div>
						<div class="text_new">{{ mb_substr($new['content'],0,127) }}{{ (mb_strlen($new['content']) > 127) ? '...' : '' }}</div>
					</a>
				@endforeach
			</div>
			@if(Auth::id() == null)
				<div class="auth">
					<div class="auth_header">Вход в личный кабинет</div>
					<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						@if($errors->has('email'))
							<div class="msg-wrong-input">{{ $errors->first('email') }}</div>
						@endif
						<input type="text" class="text_field" name="email" placeholder="Электронная почта">
						@if($errors->has('password'))
							<div class="msg-wrong-input">{{ $errors->first('password') }}</div>
						@endif
						<input type="password" class="text_field" name="password" placeholder="Пароль">
						<input type="submit" value="Вход">
					</form>
				</div>
			@endif
		</div>
	</div>
@endsection

@section('footer')
	@include('landing.footer')
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