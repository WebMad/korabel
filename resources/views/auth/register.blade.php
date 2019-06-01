@extends('main')

@section('title', 'Регистрация')

@section('content')
    <div class="login">
        <h2>Регистрация</h2>
        <p>* - обязательное поле</p>
        <form action="{{ route('register') }}" method="post" class="login_form">
            {{ csrf_field() }}

            @if ($errors->has('surname'))
                <span class="error_message">{{ $errors->first('surname') }}</span>
            @endif
            <input type="text" class="text_field" name="surname" placeholder="Фамилия">

            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" class="text_field" name="name" placeholder="Имя*">

            @if ($errors->has('patronymic'))
                <span class="error_message">{{ $errors->first('patronymic') }}</span>
            @endif
            <input type="text" class="text_field" name="patronymic" placeholder="Отчество">

            @if ($errors->has('phone'))
                <span class="error_message">{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" class="text_field" name="phone" placeholder="Номер телефона">

            @if ($errors->has('email'))
                <span class="error_message">{{ $errors->first('email') }}</span>
            @endif
            <input type="text" class="text_field" name="email" placeholder="Электронная почта*">

            @if ($errors->has('password'))
                <span class="error_message">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" class="text_field" name="password" placeholder="Пароль*">

            @if ($errors->has('password_confirmation'))
                <span class="error_message">{{ $errors->first('password_confirmation') }}</span>
            @endif
            <input type="password" class="text_field" name="password_confirmation" placeholder="Повтор пароля*">

            @if ($errors->has('confirm_politic'))
                <span class="error_message">Необходимо ознакомиться с политикой конфиденциальности.</span>
            @endif
            <p><input type="checkbox" name="confirm_politic"> Я ознакомился с политикой конфиденциальности и принимаю ее условия.</p>

            <div class="row"><input type="submit" value="Регистрация"> <a href="{{ route('login') }}">Вход</a></div>
        </form>
    </div>
@endsection
