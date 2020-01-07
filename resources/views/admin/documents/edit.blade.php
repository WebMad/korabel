@extends('admin.main')

@section('title', 'Документы')

@section('head')
@endsection

@section('content')
    <a href="{{ route('admin.documents.index') }}">Назад</a>
    <h2>Редактирование документа</h2>
    <form action="{{ route('admin.documents.update', ['document' => $document->id]) }}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <span>Название файла:</span>
            <input type="text" name="name" placeholder="Название файла" value="{{ $document->file->name }}">
            @if ($errors->has('name'))
                <span class="error_message">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Файл:</span>
            <input type="file" name="file">
            @if ($errors->has('file'))
                <span class="error_message">{{ $errors->first('file') }}</span>
            @endif
        </div>

        <div class="form-group">
            <span>Тип файла:</span>
            <select name="type" value="">
                @foreach($file_types as $file_type)
                    <option value="{{ $file_type->id }}" {{ $document->file->file_type_id == $file_type->id ? 'selected' : '' }}>
                        {{ $file_type->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('type'))
                <span class="error_message">{{ $errors->first('type') }}</span>
            @endif
        </div>

        <input type="submit" value="Сохранить">
    </form>
@endsection