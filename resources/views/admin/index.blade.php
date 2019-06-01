@extends('admin.main')

@section('title', 'Новости')

@section('head')

@endsection

@section('content')
    <div class="container">
        <form action="{{ route('admin.update') }}" method="post">
            @csrf

            <h2>Основная информация</h2>

            Название сайта:
            <input type="text" name="site_name" placeholder="Название сайта" value="{{ $info['site_name'] }}">

            Подзаголовок сайта:
            <input type="text" name="site_subname" placeholder="Подзаголовок сайта"
                   value="{{ isset($info['site_subname']) ? $info['site_subname'] : ''}}">

            Телефон в заголовке сайта:
            <input type="text" name="site_phone" placeholder="Телефон в заголовке сайта"
                   value="{{ isset($info['site_phone']) ? $info['site_phone'] : ''}}">

            <h2>Контактная информация</h2>
            Телефон:
            <input type="text" name="contact_phone" placeholder="Телефон с информацией о контактном лице"
                   value="{{ isset($info['contact_phone']) ? $info['contact_phone'] : ''}}">

            E-mail:
            <input type="text" name="contact_email" placeholder="Электронная почта"
                   value="{{ isset($info['contact_email']) ? $info['contact_email'] : ''}}">

            Адрес:
            <input type="text" name="contact_address" placeholder="Адрес"
                   value="{{ isset($info['contact_address']) ? $info['contact_address'] : ''}}">

            Адрес:
            <input type="text" name="legal_address" placeholder="Юридический адрес"
                   value="{{ isset($info['legal_address']) ? $info['legal_address'] : ''}}">

            <p>Координаты карты (Можно узнать <a href="https://yandex.ru/map-constructor/location-tool/">тут</a>):</p>
            <input type="text" name="latitude" placeholder="Широта"
                   value="{{ isset($info['latitude']) ? $info['latitude'] : ''}}">
            <input type="text" name="longitude" placeholder="Долгота"
                   value="{{ isset($info['longitude']) ? $info['longitude'] : ''}}">

            <input type="submit">
        </form>
    </div>
@endsection