@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.documents.index') }}">Назад</a>
        <h2>Редактирование документа</h2>
        <form action="{{ route('admin.documents.update', ['id' => $document['id']]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="name" placeholder="Название файла" value="{{ $document['name'] }}">

            @if ($errors->has('file'))
                <span class="error_message">{{ $errors->first('file') }}</span>
            @endif
            <input type="file" name="file"><br>

            @if ($errors->has('type'))
                <span class="error_message">{{ $errors->first('type') }}</span>
            @endif
            <select name="type">
                <option value="default" {{ $document['type'] == 'default' ? 'selected' : '' }}>Публичный</option>
                <option value="protocol" {{ $document['type'] == 'protocol' ? 'selected' : '' }}>Протокол собрания</option>
            </select><br>

            <input type="submit">
        </form>
    </div>
@endsection