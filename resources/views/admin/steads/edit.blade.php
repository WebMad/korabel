@extends('admin.main')

@section('title', 'Участки')

@section('head')
    <script src="{{ asset('js/user_search.js') }}"></script>
@endsection

@section('content')
    @if(isset($user))
        <script>
            count_delete = 2;
        </script>
    @else
        <script>
            count_delete = 1;
        </script>
    @endif
    <div class="container">
        <a href="{{ route('admin.steads.index') }}">Назад</a>
        <h2>Редактирование участка</h2>
        <form action="{{ route('admin.steads.update', ['id' => $stead->id]) }}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('number'))
                <span class="error_message">{{ $errors->first('number') }}</span>
            @endif
            <input type="text" placeholder="Номер участка" value="{{ $stead->number }}" name="number"><br>

            <input type="text" placeholder="Поиск пользователей" id="search_user" name="Поиск пользователя">
            @if ($errors->has('user_id'))
                <span class="error_message">{{ $errors->first('user_id') }}</span>
            @endif
            <select id="users" name="user_id" size="5">
                <option class="user" value="" {{ (!isset($user)) ? 'selected' : '' }}>Нет владельца</option>
                @if(isset($user))
                    <option class="user" {{ (isset($user)) ? 'selected' : '' }} value="{{ $user->user_id }}">{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</option>
                @endif

                @foreach($users as $user)
                    <option class="user" value="{{ $user->id }}">
                        {{ $user->surname }}
                        {{ $user->name }}
                        {{ $user->patronymic }}
                    </option>
                @endforeach
            </select>

            <input type="submit">
        </form>
    </div>
@endsection