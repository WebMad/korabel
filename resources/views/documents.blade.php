@extends('main')

@section('title', 'Документы')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="info">
            <h2>Документы</h2>

            <div class="row">
                @foreach($documents as $document)
                    <a href="{{ $document['file'] }}" class="file">
                        <div class="img"><img src="{{ asset($document['img']) }}" alt=""></div>
                        <div class="name">{{ $document['name'] }}</div>
                    </a>
                @endforeach
            </div>

            <p>Устав, ИНН, ОГРН, протоколы собраний, ФЗ-217, смета</p>

            <h3>Образцы заявлений</h3>
            <!--<h2>Протоколы собраний</h2>-->
        </div>
    </div>
@endsection