@extends('admin.main')

@section('title', 'Пользователи')

@section('head')

@endsection

@section('content')
    <div class="container">
        <h2>Пользователи</h2>
        <span><a href="{{ route('admin.users.create') }}">Добавить</a></span>
        <table>
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="11%">Фамилия</th>
                <th width="11%">Имя</th>
                <th width="11%">Отчество</th>
                <th width="12%">Телефон</th>
                <th width="15%">email</th>
                <th width="20%">Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['surname'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['patronymic'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit',['id'=>$user['id']]) }}">Редактировать</a>
                            |
                            <a href="{{ route('admin.users.delete', ['id' => $user['id']]) }}">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection