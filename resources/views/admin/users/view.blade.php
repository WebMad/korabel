@extends('admin.main')

@section('title', 'Пользователи')

@section('head')

@endsection

@section('content')
    <h2>Пользователи</h2>
    <span><a href="{{ route('admin.users.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="ФИО" id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
    <table>
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="11%">Фамилия</th>
            <th width="11%">Имя</th>
            <th width="15%">email</th>
            <th width="15%">Статус</th>
            <th width="20%">Действие</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->active == 1 ? 'Активный' : 'Неактивный' }}</td>
                    <td>
                        <div class="actions">
                            <a class="action-button" href="{{ route('admin.users.edit', ['id'=> $user['id']]) }}">
                                <button>Редактировать</button>
                            </a>
                            <form class="action-button" action="{{ route('admin.users.destroy', ['id'=> $user['id']]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button>Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection