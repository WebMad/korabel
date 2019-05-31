@extends('admin.main')

@section('title', 'Участки')

@section('head')
    <script src="{{ asset('js/user_search.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.steads.index') }}">Назад</a>
        <h2>Добавление участка</h2>
        <form action="{{ route('admin.steads.store') }}" method="post">
            {{ csrf_field() }}
            <input type="text" placeholder="Номер участка" name="number">
            <fieldset>
                <input type="text" placeholder="Поиск пользователей" id="search_user" name="Поиск пользователя"><br>
                <select id="users" name="user_id" size="5">
                    <option class="user" value="" selected>Нет владельца</option>
                    @foreach($users as $user)
                        <option class="user" value="{{ $user->id }}">
                            {{ $user->surname }}
                            {{ $user->name }}
                            {{ $user->patronymic }}
                        </option>
                    @endforeach
                </select>
            </fieldset>
            <input type="submit">
        </form>
    </div>
@endsection