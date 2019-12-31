<?php

namespace App\Services;


use App\Role;
use App\User;
use App\UsersRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @property User $model
 * @package App\Http\Services
 */
class UserService extends BaseService
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create($params)
    {
        $fields = [
            'email' => $params['email'],
            'surname' => $params['surname'],
            'name' => $params['name'],
            'patronymic' => $params['patronymic'],
            'phone' => isset($params['phone']) ? $params['phone'] : null,
            'password' => Hash::make($params['password']),
            'active' => isset($params['active']) ? $params['active'] : 0,
        ];

        /** @var User $user */
        $user = $this->model::create($fields);
        UsersRole::create([
            'user_id' => $user->id,
            'role_id' => isset($params['is_admin']) ? Role::ADMIN : Role::USER
        ]);

        return $user;
    }

    public function update($id, $params)
    {
        /** @var User $user */
        $user = $this->find($id);

        if (!empty($params['is_admin']) && !$user->isAdmin()) {
            $user->roles()->attach(Role::ADMIN);
        }
        if (empty($params['is_admin']) && $user->isAdmin()) {
            $user->roles()->detach(Role::ADMIN);
        }

        if (!empty($params['password'])) {
            $params['password'] = Hash::make($params['password']);
        }

        $user->fill($params)->save();
        return $user;
    }

    public function search($string, $relations = [])
    {
        $string = explode(' ', $string);

        $select = $this->all($relations);

        if (isset($string[0])) {
            $select->where('surname', 'LIKE', "%$string[0]%");
        }
        if (isset($string[1])) {
            $select->where('name', 'LIKE', "%$string[1]%");
        }
        if (isset($string[2])) {
            $select->where('patronymic', 'LIKE', "%$string[2]%");
        }

        return $select;
    }


}
