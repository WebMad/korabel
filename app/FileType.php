<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    public $timestamps = false;

    const IMAGE = 1; //Картинка
    const RECEIPT = 2; //Квитанция
    const DOCUMENT = 3; //Документ
    const PROTOCOL_MEETING = 4; //Протокол собрания
    const APPLICATION_TEMPLATE = 5; //Образец заявления

}
