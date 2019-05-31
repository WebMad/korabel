@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <div class="container">
        <h2>Документы</h2>
        <span><a href="{{ route('admin.documents.create') }}">Добавить</a></span>
        <table>
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="45%">Заголовок</th>
                <th width="10%">Ссылка</th>
                <th width="15%">Тип</th>
                <th width="25%">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document['id'] }}</td>
                    <td>{{ $document['name'] }}</td>
                    <td><a href="{{ url($document['file']) }}">Скачать</a></td>
                    <td>
                        @switch($document['type'])
                            @case('default') Публичный @break
                            @case('protocol') Протокол собрания @break
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('admin.documents.edit',['id'=>$document['id']]) }}">Редактировать</a>
                        |
                        <a href="{{ route('admin.documents.delete', ['id' => $document['id']]) }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection