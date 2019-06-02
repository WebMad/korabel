@extends('admin.main')

@section('title', 'Главная')

@section('head')

@endsection

@section('content')
    <div class="container">
        <form action="{{ route('admin.update') }}" method="post">
            @csrf

            <h2>Основная информация</h2>

            <div class="form-group">
                <span>Название сайта:</span>
                <input type="text" name="site_name" placeholder="Название сайта" value="{{ $info['site_name'] }}">
            </div>

            <div class="form-group">
                <span>Подзаголовок сайта:</span>
                <input type="text" name="site_subname" placeholder="Подзаголовок сайта"
                       value="{{ isset($info['site_subname']) ? $info['site_subname'] : ''}}">
            </div>

            <div class="form-group">
                <span>Телефон в заголовке сайта:</span>
                <input type="text" name="site_phone" placeholder="Телефон в заголовке сайта"
                       value="{{ isset($info['site_phone']) ? $info['site_phone'] : ''}}">
            </div>

            <h2>Контактная информация</h2>

            <div class="form-group">
                <span>Телефон:</span>
                <input type="text" name="contact_phone" placeholder="Телефон с информацией о контактном лице"
                       value="{{ isset($info['contact_phone']) ? $info['contact_phone'] : ''}}">
            </div>

            <div class="form-group">
                <span>E-mail:</span>
                <input type="text" name="contact_email" placeholder="Электронная почта"
                       value="{{ isset($info['contact_email']) ? $info['contact_email'] : ''}}">
                @if ($errors->has('contact_email'))
                    <span class="error_message">{{ $errors->first('contact_email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <span>Адрес:</span>
                <input type="text" name="contact_address" placeholder="Адрес"
                       value="{{ isset($info['contact_address']) ? $info['contact_address'] : ''}}">
            </div>

            <div class="form-group">
                <span>Юридический адрес:</span>
                <input type="text" name="legal_address" placeholder="Юридический адрес"
                       value="{{ isset($info['legal_address']) ? $info['legal_address'] : ''}}">
            </div>

            <div class="form-group">
                <span>Координаты карты (Можно узнать <a href="https://yandex.ru/map-constructor/location-tool/">тут</a>):</span>
                <input type="text" name="latitude" placeholder="Широта"
                       value="{{ isset($info['latitude']) ? $info['latitude'] : ''}}">
                <input type="text" name="longitude" placeholder="Долгота"
                       value="{{ isset($info['longitude']) ? $info['longitude'] : ''}}">
            </div>

            <input type="submit">
        </form>
    </div>
@endsection