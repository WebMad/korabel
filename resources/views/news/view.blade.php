@extends('main')

@section('title', 'Новости')

@section('head')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection

@section('content')
    @foreach($news as $new)
        <div class="container">
            <div class="new">
                <div class="head_new">{{ $new['header'] }}</div>
                <div class="content_new">{!! mb_substr(html_entity_decode(strip_tags($new['content'])),0,255)  !!}{{ (mb_strlen(html_entity_decode(strip_tags($new['content']))git ) > 255) ? '...' : '' }}</div>
                <div class="date_new">{{ date('d.m.y', strtotime($new['created_at']))}}</div>
                <a href="{{ route('news',['id' => $new['id']]) }}" class="more_btn_new">Подробнее</a>
            </div>
        </div>
    @endforeach
    @if(count($news) == 0)
        <div class="container">
            <div class="new">
                Ничего не найдено
            </div>
        </div>
    @endif
    {{ $news->links() }}
@endsection