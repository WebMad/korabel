@extends('admin.main')

@section('title', 'Участки')

@section('head')
    <script src="{{ asset('js/user_search.js') }}"></script>
@endsection

@section('content')
    <a href="{{ route('admin.steads.index') }}">Назад</a>
    <h2>Добавление участка</h2>
    <form action="{{ route('admin.steads.store') }}" method="post">
        @csrf

        <div class="form-group">
            <span>Номер участка:</span>
            <input type="text" placeholder="Номер участка" name="number">
            @if ($errors->has('number'))
                <span class="error_message">{{ $errors->first('number') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Владелец:</span>
            <input type="text" placeholder="Поиск пользователей" id="search_user" name="Поиск пользователя">
            <select id="users" name="user_id" size="5">
                <option class="user" value="" selected>Нет владельца</option>
            </select>
            @if ($errors->has('user_id'))
                <span class="error_message">{{ $errors->first('user_id') }}</span>
            @endif
        </div>

        <input type="submit" value="Сохранить">
    </form>
@endsection