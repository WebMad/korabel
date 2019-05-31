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
            <input type="text" name="header">
            <textarea name="content"></textarea>
            <input type="submit">
        </form>
    </div>
@endsection