@extends('admin.main')

@section('title', 'Квитанции')

@section('head')

@endsection

@section('content')
    <h2>Квитанции</h2>
    <span><a href="{{ route('admin.receipts.create') }}">Добавить</a></span><br>
    <span><a href="{{ route('admin.receipts.multiple_create') }}">Множественная загрузка</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Номер участка"
               id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
    <table>
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="30%">Участок</th>
            <th width="30%">Дата</th>
            <th width="10%">Ссылка</th>
            <th width="25%">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($receipts as $receipt)
            <tr>
                <td>{{ $receipt->id }}</td>
                <td>{{ $receipt->stead->number }}
                    - {{ isset($receipt->stead->user) ? $receipt->stead->user->getFio() : 'Нет владельца' }}</td>
                <td>{{ $months[date('n',strtotime($receipt->date_receipt))-1] . ' ' . date('Y',strtotime($receipt->date_receipt)) }}</td>
                <td><a href="{{ asset($receipt->file->url) }}">Скачать</a></td>
                <td>
                    <div class="actions">
                        <a class="action-button" href="{{ route('admin.receipts.edit', ['id'=> $receipt->id]) }}">
                            <button>Редактировать</button>
                        </a>
                        <form class="action-button"
                              action="{{ route('admin.receipts.destroy', ['id'=> $receipt->id]) }}" method="post">
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
    {{ $receipts->links() }}
@endsection