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
                    <a href="{{ $document['file'] }}" class="file">
                        <div class="img"><img src="{{ asset($document['img']) }}" alt=""></div>
                        <div class="name">{{ $document['name'] }}</div>
                    </a>
                @endforeach
                @if(count($documents) == 0)
                    Ничего не найдено
                @endif
            </div>

            <h3>Образцы заявлений</h3>
            <div class="row-file">
                @foreach($patterns as $pattern)
                    <a href="{{ $pattern['file'] }}" class="file">
                        <div class="img"><img src="{{ asset($pattern['img']) }}" alt=""></div>
                        <div class="name">{{ $pattern['name'] }}</div>
                    </a>
                @endforeach
                @if(count($patterns) == 0)
                    <p>Ничего не найдено</p>
                @endif
            </div>

            @if(Auth::user()->active == 1)
                <h3>Протоколы собраний</h3>
                <div class="row-file">
                    @foreach($protocols as $protocol)
                        <a href="{{ $protocol['file'] }}" class="file">
                            <div class="img"><img src="{{ asset($protocol['img']) }}" alt=""></div>
                            <div class="name">{{ $protocol['name'] }}</div>
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