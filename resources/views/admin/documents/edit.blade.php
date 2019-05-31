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
            <input type="text" name="name" value="{{ $document['name'] }}">
            <input type="file" name="file">
            <select name="type">
                <option value="default" {{ $document['type'] == 'default' ? 'selected' : '' }}>Публичный</option>
                <option value="protocol" {{ $document['type'] == 'protocol' ? 'selected' : '' }}>Протокол собрания</option>
            </select>
            <input type="submit">
        </form>
    </div>
@endsection