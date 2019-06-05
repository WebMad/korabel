@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <a href="{{ route('admin.documents.index') }}">Назад</a>
    <h2>Редактирование документа</h2>
    <form action="{{ route('admin.documents.update', ['id' => $document['id']]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <span>Название файла:</span>
            <input type="text" name="name" placeholder="Название файла" value="{{ $document['name'] }}">
            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Файл:</span>
            <input type="file" name="file">
            @if ($errors->has('file'))
                <span class="error_message">{{ $errors->first('file') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Тип файла:</span>
            <select name="type">
                <option value="default" {{ $document['type'] == 'default' ? 'selected' : '' }}>Публичный</option>
                <option value="protocol" {{ $document['type'] == 'protocol' ? 'selected' : '' }}>Протокол собрания</option>
                <option value="pattern" {{ $document['type'] == 'pattern' ? 'selected' : '' }}>Образец заявления</option>
            </select>
            @if ($errors->has('type'))
                <span class="error_message">{{ $errors->first('type') }}</span>
            @endif
        </div>

        <input type="submit">
    </form>
@endsection