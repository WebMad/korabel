@extends('admin.main')

@section('title', 'Новости')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <a href="{{ route('admin.news.index') }}">Назад</a>
    <h2>Создание новости</h2>
    <form action="{{ route('admin.news.store') }}" method="post">
        @csrf

        <div class="form-group">
            <span>Заголовок:</span>
            <input type="text" name="header" placeholder="Заголовок">
            @if ($errors->has('header'))
                <span class="error_message">{{ $errors->first('header') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Текст новости:</span>
            <textarea name="content" placeholder="Текст новости"></textarea>
            @if ($errors->has('content'))
                <span class="error_message">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <input type="submit" value="Сохранить">
    </form>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection