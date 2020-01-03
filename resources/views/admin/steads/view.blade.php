@extends('admin.main')

@section('title', 'Участки')

@section('head')

@endsection

@section('content')
    <h2>Участки</h2>
    <span><a href="{{ route('admin.steads.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Номер участка"
               id="search_fields"><input type="submit" id="search_btn" value="искать">
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
                <td>{{ (isset($stead->user)) ? $stead->user->surname . " " . $stead->user->name . " " . $stead->user->patronymic : 'Нет владельца' }}</td>
                <td>
                    <div class="actions">
                        <a class="action-button" href="{{ route('admin.steads.edit', ['stead'=> $stead->id]) }}">
                            <button>Редактировать</button>
                        </a>
                        <form class="action-button" action="{{ route('admin.steads.destroy', ['stead'=> $stead->id]) }}" method="post">
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
    {{ $steads->links() }}
@endsection