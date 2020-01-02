<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Http\Services
 */
abstract class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращает все записи в таблице
     * @param array $relations
     * @return Builder|Model
     */
    public function all($relations = [])
    {
        return $this->model::with($relations);
    }

    /**
     * Создает запись и возвращает ее
     * @param $params
     * @return Model
     */
    public function create($params)
    {
        return $this->model::create($params);
    }

    /**
     * Возврщает запись по id
     * @param int $id
     * @param $relations
     * @return Model
     */
    public function find($id, $relations = [])
    {
        return $this->model::with($relations)->find($id);
    }

    /**
     * @param $id
     * @param $params
     * @return Model
     */
    public function update($id, $params)
    {
        /** @var Model $model */
        $model = $this->find($id);
        $model->update($params);
        return $model;
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function delete($id)
    {
        /** @var Model $model */
        $model = $this->find($id);
        $model->delete();
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

}
