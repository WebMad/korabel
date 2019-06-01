@extends('main')

@section('title', 'Контакты')

@section('head')

@endsection

@section('content')
    <div class="container">
        <div class="info">
            <h2>Контакты</h2>
            <p>
                <b>Телефон:</b> {{ isset($info['contact_phone']) ? $info['contact_phone'] : ''}}<br>
                <b>Электронная почта:</b> {{ isset($info['contact_email']) ? $info['contact_email'] : ''}}<br>
                <b>Адрес:</b> {{ isset($info['contact_address']) ? $info['contact_address'] : ''}}<br>
                <b>Юр. адрес:</b> {{ isset($info['legal_address']) ? $info['legal_address'] : ''}}
            </p>
            <iframe src="https://yandex.ru/map-widget/v1/?ll={{ isset($info['longitude']) ? $info['longitude'] : ''}},{{ isset($info['latitude']) ? $info['latitude'] : ''}}&z=16" height="400" frameborder="1" allowfullscreen="true"></iframe>
        </div>
    </div>
@endsection