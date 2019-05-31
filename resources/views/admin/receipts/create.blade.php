@extends('admin.main')

@section('title', 'Квитанции')

@section('head')
    <script src="{{ asset('js/stead_search.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.receipts.index') }}">Назад</a>
        <h2>Добавление квитанции</h2>
        <form action="{{ route('admin.receipts.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($errors->has('receipts'))
                <span class="error_message">Выберите файл</span>
            @endif
            <input type="file" accept="application/pdf" name="receipts"><br>

            @if ($errors->has('date_receipt'))
                <span class="error_message">Выберите месяц</span>
            @endif
            <input type="month" name="date_receipt"><br>

            <input type="text" placeholder="Поиск участка" id="search_stead">
            @if ($errors->has('stead_id'))
                <span class="error_message">Выберите участок</span>
            @endif
            <select id="steads" name="stead_id" size="5">
                @foreach($steads as $stead)
                    <option class="user" value="{{ $stead->id }}">
                        {{ $stead->number }} -
                        {{ $stead->surname }}
                        {{ $stead->name }}
                        {{ $stead->patronymic }}
                    </option>
                @endforeach
            </select><br>

            <input type="submit">
        </form>
    </div>
@endsection