@extends('main')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="login">
        <h2>Восстановление пароля</h2>
        <form action="{{ route('password.update') }}" method="post" class="login_form">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="text" name="email" placeholder="Электронная почта" value="{{ $email ?? old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="error_message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Новый пароль">
                @if ($errors->has('password'))
                    <span class="error_message">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Повтор пароля">
                @if ($errors->has('password_confirmation'))
                    <span class="error_message">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="row"><input type="submit" value="Восстановить"> <a href="{{ route('login') }}">Вход</a></div>
        </form>
    </div>
@endsection