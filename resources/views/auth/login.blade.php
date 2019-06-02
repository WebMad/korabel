@extends('main')

@section('title', 'Авторизация')

@section('content')
    <div class="login">
        <h2>Вход в личный кабинет</h2>
        @if ($errors->has('email'))
            <span class="error_message">Неверный логин или пароль</span>
        @endif
        <form action="{{ route('login') }}" method="post" class="login_form">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="email" placeholder="Электронная почта">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль">
            </div>

            <div class="row"><input type="submit" value="Вход"> <a href="{{ route('register') }}">Регистрация</a></div>
        </form>
    </div>
@endsection