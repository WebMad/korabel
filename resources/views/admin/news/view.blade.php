@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <div class="container">
        <h2>Новости</h2>
        <span><a href="{{ route('admin.news.create') }}">Добавить</a></span>
        <table>
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="70%">Заголовок</th>
                    <th width="25%">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $new)
                <tr>
                    <td>{{ $new['id'] }}</td>
                    <td>{{ $new['header'] }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit',['id'=>$new['id']]) }}">Редактировать</a>
                        |
                        <a href="{{ route('admin.news.delete', ['id' => $new['id']]) }}">Удалить</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection