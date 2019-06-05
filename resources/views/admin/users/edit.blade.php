@extends('admin.main')

@section('title', 'Пользователи')

@section('head')

@endsection

@section('content')
    <a href="{{ route('admin.users.index') }}">Назад</a>
    <h2>Редактирование пользователя</h2>
    <form action="{{ route('admin.users.update', ['id' => $user['id']]) }}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <span>Фамилия</span>
            <input type="text" name="surname" placeholder="Фамилия" value="{{ $user['surname'] }}">
            @if ($errors->has('surname'))
                <span class="error_message">{{ $errors->first('surname') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Имя</span>
            <input type="text" name="name" placeholder="Имя" value="{{ $user['name'] }}">
            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Отчество</span>
            <input type="text" name="patronymic" placeholder="Отчество" value="{{ $user['patronymic'] }}">
            @if ($errors->has('patronymic'))
                <span class="error_message">{{ $errors->first('patronymic') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Электронная почта:</span>
            <input type="email" name="email" placeholder="Электронная почта" value="{{ $user['email'] }}">
            @if ($errors->has('email'))
                <span class="error_message">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Телефон:</span>
            <input type="text" name="phone" placeholder="Номер телефона" value="{{ $user['phone'] }}">
            @if ($errors->has('phone'))
                <span class="error_message">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Новый пароль:</span>
            <input type="password" name="password" placeholder="Новый пароль">
            @if ($errors->has('password'))
                <span class="error_message">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Повторите пароль:</span>
            <input type="password" name="password_confirmation" placeholder="Повторите пароль">
            @if ($errors->has('password_confirmation'))
                <span class="error_message">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Статус:</span>
            <select name="active">
                <option value="0" {{ $user['active'] == 0 ? 'selected' : '' }}>Неактивен</option>
                <option value="1" {{ $user['active'] == 1 ? 'selected' : '' }}>Активен</option>
            </select>
            @if ($errors->has('active'))
                <span class="error_message">{{ $errors->first('active') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Админ <input type="checkbox" name="is_admin" {{ $user['is_admin'] ? 'checked' : '' }}></span>
            @if ($errors->has('is_admin'))
                <span class="error_message">{{ $errors->first('is_admin') }}</span>
            @endif
        </div>

        <input type="submit">
    </form>
@endsection