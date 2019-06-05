<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inputs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/house-icon.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src='{{ asset('js/script.js') }}'></script>
    @yield('head')
</head>
<body>
    <div id="container">
        <div class="left_menu">
            <div class="logo"></div>
            <ul class="menu">
                <li class="element-menu"><a href="{{ route('admin.index') }}">Главная</a></li>
                <li class="element-menu"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                <li class="element-menu"><a href="{{ route('admin.steads.index') }}">Участки</a></li>
                <li class="element-menu"><a href="{{ route('admin.receipts.index') }}">Квитанции</a></li>
                <li class="element-menu"><a href="{{ route('admin.news.index') }}">Новости</a></li>
                <li class="element-menu"><a href="{{ route('admin.documents.index') }}">Документы</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="container">
                @if(session('msg.status'))
                    <div class="msg-box {{ session('msg.status') }}">
                        <div class="msg-text">
                            {{session('msg.text')}}
                            @if(session('msg.steads'))
                                <br>
                                @foreach(session('msg.steads') as $stead)
                                    {{ $stead }}<br>
                                @endforeach
                            @endif
                        </div>
                        <div class="msg-close"></div>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>

        @yield('scripts_end')
    </div>
</body>
</html>