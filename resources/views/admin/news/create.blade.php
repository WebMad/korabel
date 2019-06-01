@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.news.index') }}">Назад</a>
        <h2>Создание новости</h2>
        <form action="{{ route('admin.news.store') }}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('header'))
                <span class="error_message">{{ $errors->first('header') }}</span>
            @endif
            <input type="text" name="header" placeholder="Заголовок">

            @if ($errors->has('content'))
                <span class="error_message">{{ $errors->first('content') }}</span>
            @endif
            <textarea name="content" placeholder="Текст новости"></textarea>
            <input type="submit">
        </form>
    </div>
@endsection