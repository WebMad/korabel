@extends('main')

@section('title', 'Регистрация')

@section('content')
    <div class="login">
        <h2>Регистрация</h2>
        <p>* - обязательное поле</p>
        <form action="{{ route('register') }}" method="post" class="login_form">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="text" name="surname" placeholder="Фамилия">
                @if ($errors->has('surname'))
                    <span class="error_message">{{ $errors->first('surname') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="text" name="name" placeholder="Имя*">
                @if ($errors->has('name'))
                    <span class="error_message">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="text" name="patronymic" placeholder="Отчество">
                @if ($errors->has('patronymic'))
                    <span class="error_message">{{ $errors->first('patronymic') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="text" name="phone" placeholder="Номер телефона">
                @if ($errors->has('phone'))
                    <span class="error_message">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="text" name="email" placeholder="Электронная почта*">
                @if ($errors->has('email'))
                    <span class="error_message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль*">
                @if ($errors->has('password'))
                    <span class="error_message">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Повтор пароля*">
                @if ($errors->has('password_confirmation'))
                    <span class="error_message">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="form-group">
                <span><input type="checkbox" name="confirm_politic"> Я ознакомился с <a href="{{ asset('uploads/politikaconf.rtf') }}">политикой конфиденциальности</a> и принимаю ее условия.</span>
                @if ($errors->has('confirm_politic'))
                    <span class="error_message">Необходимо ознакомиться с политикой конфиденциальности.</span>
                @endif
            </div>
            <div class="form-group">
                {!! Captcha::display($attributes = [], $options = ['lang'=> 'ru']) !!}
            </div>

            <div class="row"><input type="submit" value="Регистрация"> <a href="{{ route('login') }}">Вход</a></div>
        </form>
    </div>
@endsection
