@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.news.index') }}">Назад</a>
        <h2>Редактирование новости</h2>
        <form action="{{ route('admin.news.update',['id' => $new['id']]) }}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('header'))
                <span class="error_message">{{ $errors->first('header') }}</span>
            @endif
            <input type="text" name="header" placeholder="Заголовок" value="{{ $new['header'] }}">

            @if ($errors->has('content'))
                <span class="error_message">{{ $errors->first('content') }}</span>
            @endif
            <textarea name="content"  placeholder="Текст новости">{{ $new['content'] }}</textarea>
            <input type="submit">
        </form>
    </div>
@endsection