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
            <input type="text" name="header" value="{{ $new['header'] }}">
            <textarea name="content">{{ $new['content'] }}</textarea>
            <input type="submit">
        </form>
    </div>
@endsection