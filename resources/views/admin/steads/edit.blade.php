@extends('admin.main')

@section('title', 'Участки')

@section('head')
    <script src="{{ asset('js/user_search.js') }}"></script>
@endsection

@section('content')
    @if(isset($stead->user))
        <script>
            count_delete = 2;
        </script>
    @else
        <script>
            count_delete = 1;
        </script>
    @endif
    <a href="{{ route('admin.steads.index') }}">Назад</a>
    <h2>Редактирование участка</h2>
    <form action="{{ route('admin.steads.update', ['id' => $stead->id]) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <span>Номер участка:</span>
            <input type="text" placeholder="Номер участка" value="{{ $stead->number }}" name="number">
            @if ($errors->has('number'))
                <span class="error_message">{{ $errors->first('number') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Владелец:</span>
            <input type="text" placeholder="Поиск пользователей" id="search_user" name="Поиск пользователя">
            <select id="users" name="user_id" size="5">
                <option class="user" value="" {{ (!isset($stead->user)) ? 'selected' : '' }}>Нет владельца</option>
                @if(isset($stead->user))
                    <option value="{{ $stead->user->id }}" selected>{{ $stead->user->surname . ' ' . $stead->user->name . ' ' . $stead->user->patronymic }}</option>
                @endif
            </select>
            @if ($errors->has('user_id'))
                <span class="error_message">{{ $errors->first('user_id') }}</span>
            @endif
        </div>

        <input type="submit" value="Сохранить">
    </form>
@endsection