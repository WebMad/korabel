@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <h2>Документы</h2>
    <span><a href="{{ route('admin.documents.create') }}">Добавить</a></span>
    <form class="search-fields">
        <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Заголовок файла" id="search_fields"><input type="submit" id="search_btn" value="искать">
    </form>
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
                <td>{{ $document->id }}</td>
                <td>{{ $document->file->name }}</td>
                <td><a href="{{ url($document->file->url) }}">Скачать</a></td>
                <td>{{ $document->file->fileType->name }}</td>
                <td>
                    <div class="actions">
                        <a class="action-button" href="{{ route('admin.documents.edit', ['id'=> $document->id]) }}">
                            <button>Редактировать</button>
                        </a>
                        <form class="action-button" action="{{ route('admin.documents.destroy', ['id'=> $document->id]) }}" method="post">
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
    {{ $documents->links() }}
@endsection