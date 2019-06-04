@extends('main')

@section('title', 'Новости')

@section('head')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="new">
            <div class="head_new">{{ $new['header'] }}</div>
            <div class="content_full_new">{!!$new['content'] !!}</div>
            <div class="date_new">{{ date('d.m.y',strtotime($new['created_at'])) }}</div>
        </div>
    </div>
@endsection