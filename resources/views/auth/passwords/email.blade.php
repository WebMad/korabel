@extends('main')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="login">
        <h2>Восстановление пароля</h2>
        <form action="{{ route('password.email') }}" method="post" class="login_form">
            @csrf

            <div class="form-group">
                <input type="text" name="email" placeholder="Электронная почта">
                @if ($errors->has('email'))
                    <span class="error_message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="row"><input type="submit" value="Восстановить"> <a href="{{ route('login') }}">Вход</a></div>
        </form>
    </div>
@endsection