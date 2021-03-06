# Корабел
Данная система разработана для систематизации работы в садоводческих товариществах

## Развертывание приложения
Первым делом необходимо склонировать проект: 

```
$ git clone https://github.com/WebMad/korabel.git
```

После клонирования делаем стандартную настройку:

```
$ composer install
```

Далее настройте подключение к базе данных и установите начальные настройки приложения. Cкопируйте файл `example.env` и переименуйте его в `.env`

```
APP_NAME=<НАЗВАНИЕ САЙТА, ОРГАНИЗАЦИИ>
APP_URL=<АДРЕС САЙТА>

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=2506
DB_DATABASE=<ИМЯ ВАШЕЙ БАЗЫ ДАННЫХ>
DB_USERNAME=<ПОЛЬЗОВАТЕЛЬ>
DB_PASSWORD=<ПАРОЛЬ>

MAIL_DRIVER=smtp
MAIL_HOST=<АДРЕС SMTP СЕРВЕРА>
MAIL_PORT=<ПОРТ SMTP СЕРВЕРА>
MAIL_USERNAME="<АДРЕС С КОТОРОГО ПРОИЗВОДИТСЯ РАССЫЛКА>"
MAIL_PASSWORD=<ПАРОЛЬ SMTP СЕРВЕРА>
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS="<АДРЕС С КОТОРОГО ПРОИЗВОДИТСЯ РАССЫЛКА>"
MAIL_FROM_NAME="<ОТ КОГО СООБЩЕНИЕ>"

SU_NAME=<Имя администратора>
SU_SURNAME=<Фамилия администратора>
SU_PATRONYMIC=<Отчество администратора>
SU_EMAIL=<E-mail администратора>
SU_PASSWORD=<Пароль администратора>

CAPTCHA_SECRET=<СЕКРЕТНЫЙ КЛЮЧ RECAPTCHA>
CAPTCHA_SITEKEY=<КЛЮЧ RECAPTCHA>
```

Затем сгенерируйте ключ приложения

```
$ php artisan key:generate
```

Теперь необходимо провести миграцию и заполнить базу данных:

```
$ php artisan migrate --seed
```

Создайте ссылку на storage:

```
$ php artisan storage:link
```

Поздравляю! Теперь тебе просто необходимо открыть проект в браузере
