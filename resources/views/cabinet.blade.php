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

                        <div class="form-group">
                            <span>Фамилия:</span>
                            <input type="text" name="surname" placeholder="Фамилия" value="{{ $user['surname'] }}">
                            @if($errors->has('surname'))
                                <div class="msg-wrong-input">{{ $errors->first('surname') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Имя:</span>
                            <input type="text" name="name" placeholder="Имя" value="{{ $user['name'] }}">
                            @if($errors->has('name'))
                                <div class="msg-wrong-input">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Отчество:</span>
                            <input type="text" name="patronymic" placeholder="Отчество" value="{{ $user['patronymic'] }}">
                            @if($errors->has('patronymic'))
                                <div class="msg-wrong-input">{{ $errors->first('patronymic') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Электронная почта:</span>
                            <input type="email" name="email" placeholder="Электронная почта" value="{{ $user['email'] }}">
                            @if($errors->has('email'))
                                <div class="msg-wrong-input">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Телефон:</span>
                            <input type="text" name="phone" placeholder="Номер телефона" value="{{ $user['phone'] }}">
                            @if($errors->has('phone'))
                                <div class="msg-wrong-input">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Новый пароль:</span>
                            <input type="password" name="password" placeholder="Новый пароль">
                            @if($errors->has('password'))
                                <div class="msg-wrong-input">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <span>Повтор пароля:</span>
                            <input type="password" name="password_confirmation" placeholder="Повтор пароля">
                            @if($errors->has('password_confirmation'))
                                <div class="msg-wrong-input">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

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
                                        <a href="{{ $receipt['file'] }}" target="_blank" class="receipt-file">
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