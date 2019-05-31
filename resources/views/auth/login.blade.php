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
            <input type="text" class="text_field" name="email" placeholder="Электронная почта">
            <input type="password" class="text_field" name="password" placeholder="Пароль">
            <input type="submit" value="Вход">
        </form>
    </div>
@endsection