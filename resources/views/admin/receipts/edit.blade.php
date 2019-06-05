@extends('admin.main')

@section('title', 'Квитанции')

@section('head')
    <script src="{{ asset('js/stead_search.js') }}"></script>
@endsection

@section('content')
    <script>
        count_delete = 1;
    </script>
    <a href="{{ route('admin.receipts.index') }}">Назад</a>
    <h2>Редактирование квитанции</h2>
    <form action="{{ route('admin.receipts.update', [$receipt->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <span>Файл:</span>
            <input type="file" accept="application/pdf" name="receipts">
            @if ($errors->has('receipts'))
                <span class="error_message">Выберите файл</span>
            @endif
        </div>

        <div class="form-group">
            <span>Месяц:</span>
            <input type="month" value="{{ $receipt->date_receipt }}" name="date_receipt">
            @if ($errors->has('date_receipt'))
                <span class="error_message">Выберите месяц</span>
            @endif
        </div>

        <div class="form-group">
            <span>Участок:</span>
            <input type="text" placeholder="Поиск участка" id="search_stead">
            <select id="steads" name="stead_id" size="5">
                <option selected value="{{ $stead->id }}">{{ $stead->number }} - {{ $stead->surname }} {{ $stead->name }} {{ $stead->patronymic }}</option>
                @foreach($steads as $stead)
                    <option class="user" value="{{ $stead->id }}">
                        {{ $stead->number }} -
                        {{ $stead->surname }}
                        {{ $stead->name }}
                        {{ $stead->patronymic }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('stead_id'))
                <span class="error_message">Выберите участок</span>
            @endif
        </div>

        <input type="submit">
    </form>
@endsection