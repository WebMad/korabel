@extends('admin.main')

@section('title', 'Новости')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <a href="{{ route('admin.news.index') }}">Назад</a>
    <h2>Редактирование новости</h2>
    <form action="{{ route('admin.news.update',['id' => $new['id']]) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <span>Заголовок</span>
            <input type="text" name="header" placeholder="Заголовок" value="{{ $new['header'] }}">
            @if ($errors->has('header'))
                <span class="error_message">{{ $errors->first('header') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Текст новости:</span>
            <textarea name="content"  placeholder="Текст новости">{{ $new['content'] }}</textarea>
            @if ($errors->has('content'))
                <span class="error_message">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <input type="submit">
    </form>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection