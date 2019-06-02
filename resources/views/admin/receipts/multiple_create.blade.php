@extends('admin.main')

@section('title', 'Квитанции')

@section('head')
    <script src="{{ asset('js/stead_search.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.receipts.index') }}">Назад</a>
        <h2>Добавление квитанций</h2>
        <form action="{{ route('admin.receipts.multiple_store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">Все загружаемые файлы должны соответсвовать формату: [номер участка].pdf</div>

            <div class="form-group">
                <span>Выберите все квитанции:</span>
                <input type="file" accept="application/pdf" multiple name="receipts[]">
                @if ($errors->has('receipts'))
                    <span class="error_message">Выберите файлы</span>
                @endif
            </div>

            <div class="form-group">
                <span>Дата:</span>
                <input type="month" name="date_receipt">
                @if ($errors->has('date_receipt'))
                    <span class="error_message">Выберите дату</span>
                @endif
            </div>

            <input type="submit">
        </form>
    </div>
@endsection