@extends('admin.main')

@section('title', 'Документы')

@section('head')

@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.documents.index') }}">Назад</a>
        <h2>Загрузка документа</h2>
        <form action="{{ route('admin.documents.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="name">
            <input type="file" name="file">
            <select name="type">
                <option value="default" selected>Публичный</option>
                <option value="protocol">Протокол собрания</option>
            </select>
            <input type="submit">
        </form>
    </div>
@endsection