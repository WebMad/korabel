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
    <form action="{{ route('admin.receipts.update', ['receipt' => $receipt->id]) }}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
            <span>Файл:</span>
            <input type="file" accept="application/pdf" name="receipt_file">
            @if ($errors->has('receipt_file'))
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
                <option selected value="{{ $stead->id }}">{{ $stead->number }}
                    - {{ ($stead->user) ? $stead->user->surname . " " . $stead->user->name . " " . $stead->user->patronymic : 'Нет владельца' }}</option>
            </select>
            @if ($errors->has('stead_id'))
                <span class="error_message">Выберите участок</span>
            @endif
        </div>

        <input type="submit" value="Сохранить">
    </form>
@endsection