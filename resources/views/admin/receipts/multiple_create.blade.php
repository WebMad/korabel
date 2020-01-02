@extends('admin.main')

@section('title', 'Квитанции')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/upload_receipts.css') }}">
@endsection

@section('content')
    <div class="flex-container">
        <div>
            <a href="{{ route('admin.receipts.index') }}">Назад</a>
            <h2>Добавление квитанций</h2>
            <form id="form_receipts" action="{{ route('admin.receipts.multiple_store') }}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">Все загружаемые файлы должны соответсвовать формату: [номер участка].pdf</div>

                <div class="form-group">
                    <span>Выберите все квитанции:</span>
                    <input type="file" id="receipts_input" accept="application/pdf" multiple name="receipts[]">
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
        <div class="left_part files" id="files">

        </div>
    </div>
@endsection

@section('scripts_end')
    <script src="{{ asset('js/multiple_upload_receipts.js') }}"></script>
@endsection