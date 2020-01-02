@extends('main')

@section('title', 'Документы')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="info">
            <h2>Документы</h2>

            <div class="row-file">
                @foreach($documents as $document)
                    <a href="{{ $document->file->url }}" class="file">
                        <div class="img"><img src="{{ asset($document->file->img) }}" alt=""></div>
                        <div class="name">{{ $document->file->name }}</div>
                    </a>
                @endforeach
                @if(count($documents) == 0)
                    Ничего не найдено
                @endif
            </div>

            <h3>Образцы заявлений</h3>
            <div class="row-file">
                @foreach($patterns as $pattern)
                    <a href="{{ $pattern->file->url }}" class="file">
                        <div class="img"><img src="{{ asset($pattern->file->img) }}" alt=""></div>
                        <div class="name">{{ $pattern->file->name }}</div>
                    </a>
                @endforeach
                @if(count($patterns) == 0)
                    <p>Ничего не найдено</p>
                @endif
            </div>

            @if(isset(Auth::user()->active) and Auth::user()->isAdmin())
                <h3>Протоколы собраний</h3>
                <div class="row-file">
                    @foreach($protocols as $protocol)
                        <a href="{{ $protocol->file->url }}" class="file">
                            <div class="img"><img src="{{ asset($protocol->file->img) }}" alt=""></div>
                            <div class="name">{{ $protocol->file->name }}</div>
                        </a>
                    @endforeach
                    @if(count($protocols) == 0)
                        <p>Ничего не найдено</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection