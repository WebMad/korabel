@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <h2>Новости</h2>
    <span><a href="{{ route('admin.news.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Заголовок" id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
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
@endsection