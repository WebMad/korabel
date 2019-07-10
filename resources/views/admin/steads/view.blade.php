@extends('admin.main')

@section('title', 'Участки')

@section('head')

@endsection

@section('content')
    <h2>Участки</h2>
    <span><a href="{{ route('admin.steads.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Номер участка" id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
    <table>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="20%">Номер участка</th>
                <th width="50%">Владелец</th>
                <th width="25%">Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($steads as $stead)
                <tr>
                    <td>{{ $stead->id }}</td>
                    <td>{{ $stead->number }}</td>
                    <td>{{ $stead->surname }} {{ $stead->name }} {{ $stead->patronymic }}</td>
                    <td>
                        <a href="{{ route('admin.steads.edit',['id'=>$stead->id]) }}">Редактировать</a>
                        |
                        <a href="{{ route('admin.steads.delete', ['id' => $stead->id] ) }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $steads->links() }}
@endsection