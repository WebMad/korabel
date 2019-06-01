@extends('main')

@section('title', 'Личный кабинет')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="info">
            <h2>Личный кабинет</h2>

            <div class="row">
                <div class="info-user">
                    <h3>Информация</h3>
                    @if(session('msg.status'))
                        <div class="msg-box {{ session('msg.status') }}">
                            <div class="msg-text">{{session('msg.text')}}</div>
                            <div class="msg-close"></div>
                        </div>
                    @endif
                    <p><b>Статус:</b> {{ $user['active'] == 0 ? 'неактивный, администратор проверяет вашу информацию, поcле чего вы получите полный доступ ко всем функциям сайта.' : 'активный'}}</p>
                    <form action="{{ route('cabinet.user.update')}}" method="post">
                        @csrf
                        @if($errors->has('surname'))
                            <div class="msg-wrong-input">{{ $errors->first('surname') }}</div>
                        @endif
                        <input type="text" class="text_field" name="surname" placeholder="Фамилия" value="{{ $user['surname'] }}"><br>

                        @if($errors->has('name'))
                            <div class="msg-wrong-input">{{ $errors->first('name') }}</div>
                        @endif
                        <input type="text" class="text_field" name="name" placeholder="Имя" value="{{ $user['name'] }}"><br>

                        @if($errors->has('patronymic'))
                            <div class="msg-wrong-input">{{ $errors->first('patronymic') }}</div>
                        @endif
                        <input type="text" class="text_field" name="patronymic" placeholder="Отчество" value="{{ $user['patronymic'] }}"><br>

                        @if($errors->has('email'))
                            <div class="msg-wrong-input">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="email" class="text_field" name="email" placeholder="Электронная почта" value="{{ $user['email'] }}"><br>

                        @if($errors->has('phone'))
                            <div class="msg-wrong-input">{{ $errors->first('phone') }}</div>
                        @endif
                        <input type="text" class="text_field" name="phone" placeholder="Номер телефона" value="{{ $user['phone'] }}"><br>

                        @if($errors->has('password'))
                            <div class="msg-wrong-input">{{ $errors->first('password') }}</div>
                        @endif
                        <input type="password" class="text_field" name="password" placeholder="Новый пароль"><br>
                        <input type="submit">
                    </form>
                </div>
                @if(Auth::user()->active == 1)
                    <div class="documents-user">
                        <h3>Квитанции</h3>
                        @foreach($steads as $stead)
                            <div class="stead">
                                <div class="number-stead">Участок №{{ $stead->number }}</div>
                                <div class="receipts-stead">
                                    @foreach($stead->receipts as $receipt)
                                        <a href="{{ $receipt['file'] }}" class="receipt-file">
                                            <div class="receipt-name">{{ $months[date('n',strtotime($receipt->date_receipt))-1] . ' ' . date('Y',strtotime($receipt->date_receipt)) }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection