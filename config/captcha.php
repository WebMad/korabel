<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'secret' => env('CAPTCHA_SECRET', '6Les4KcUAAAAAGia2NcGKSK_oLwv22Jkv2BxbA_R'),
    'sitekey' => env('CAPTCHA_SITEKEY', '6Les4KcUAAAAAJt2VguSDc8tBf3liJLDjMV-Vjnw'),
    /**
     * @var string|null Default ``null``.
     * Custom with function name (example customRequestCaptcha) or class@method (example \App\CustomRequestCaptcha@custom).
     * Function must be return instance, read more in folder ``examples``
     */
    'request_method' => null,
    'options' => [
        'multiple' => false,
        'lang' => app()->getLocale(),
    ],
    'attributes' => [
        'theme' => 'light'
    ],
];