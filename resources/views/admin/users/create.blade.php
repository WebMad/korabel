@extends('admin.main')

@section('title', 'Пользователи')

@section('head')

@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.users.index') }}">Назад</a>
        <h2>Создание пользователя</h2>
        <form action="{{ route('admin.users.store') }}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('surname'))
                <span class="error_message">{{ $errors->first('surname') }}</span>
            @endif
            <input type="text" name="surname" placeholder="Фамилия">

            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="name" placeholder="Имя">

            @if ($errors->has('patronymic'))
                <span class="error_message">{{ $errors->first('patronymic') }}</span>
            @endif
            <input type="text" name="patronymic" placeholder="Отчество">

            @if ($errors->has('email'))
                <span class="error_message">{{ $errors->first('email') }}</span>
            @endif
            <input type="email" name="email" placeholder="Электронная почта">

            @if ($errors->has('phone'))
                <span class="error_message">{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" name="phone" placeholder="Номер телефона">

            @if ($errors->has('password'))
                <span class="error_message">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" name="password" placeholder="Пароль">

            @if ($errors->has('active'))
                <span class="error_message">{{ $errors->first('active') }}</span>
            @endif
            Статус:
            <select name="active">
                <option value="0" selected>Неактивен</option>
                <option value="1">Активен</option>
            </select>

            @if ($errors->has('is_admin'))
                <span class="error_message">{{ $errors->first('is_admin') }}</span>
            @endif
            <p>Админ <input type="checkbox" name="is_admin"></p>

            <input type="submit">
        </form>
    </div>
@endsection