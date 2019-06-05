@extends('admin.main')

@section('title', 'Квитанции')

@section('head')

@endsection

@section('content')
    <h2>Квитанции</h2>
    <span><a href="{{ route('admin.receipts.create') }}">Добавить</a></span><br>
    <span><a href="{{ route('admin.receipts.multiple_create') }}">Множественная загрузка</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Номер участка" id="search_fields"><input type="submit" id="search_btn" value="искать">
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
                    <td>{{ $receipt->number }}</td>
                    <td>{{ $months[date('n',strtotime($receipt->date_receipt))-1] . ' ' . date('Y',strtotime($receipt->date_receipt)) }}</td>
                    <td><a href="{{ url($receipt->file) }}">Скачать</a></td>
                    <td>
                        <a href="{{ route('admin.receipts.edit',['id'=>$receipt->id]) }}">Редактировать</a>
                        |
                        <a href="{{ route('admin.receipts.delete', ['id' => $receipt->id] ) }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $receipts->links() }}
@endsection