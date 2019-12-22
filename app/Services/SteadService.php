<?php

namespace App\Services;

use App\Stead;
use App\User;

/**
 * Class SteadService
 * @property User $model
 * @package App\Http\Services
 */
class SteadService extends BaseService
{

    public function __construct(Stead $stead)
    {
        parent::__construct($stead);
    }

    public function search($search, $relations = []) {
        return $this->all($relations)->where('steads.number', 'LIKE', "%$search%");
    }

}
