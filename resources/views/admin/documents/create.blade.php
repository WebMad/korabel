@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <a href="{{ route('admin.documents.index') }}">Назад</a>
    <h2>Загрузка документа</h2>
    <form action="{{ route('admin.documents.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <span>Название сайта:</span>
            <input type="text" placeholder="Название файла" name="name">
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
                <option value="default" selected>Публичный</option>
                <option value="protocol">Протокол собрания</option>
                <option value="pattern">Образец заявления</option>
            </select>
            @if ($errors->has('type'))
                <span class="error_message">{{ $errors->first('type') }}</span>
            @endif
        </div>

        <input type="submit">
    </form>
@endsection