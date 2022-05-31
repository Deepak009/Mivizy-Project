<?php

namespace App\Services;

use DB;
use Exception;
use App\Models\Role;
use App\Models\User;

class UserService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param User           $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
	 * Model create method
	 *
	 * @param array $payload
	 * @return Model
	 */
	public function create(array $payload)
	{
        try{
            DB::beginTransaction();
            $model = new $this->model;
            // filter out the allowable payload
            $payload = collect($payload);
            $payload = $payload->only($this->model->getFillable())->toArray();
            $password = $payload["password"]??randomString(8);
            $model->fill($payload);
			$model->password = bcrypt($password);
            $model->save();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
		return $model;
	}

    /**
     * Find the user by country_code and phone_number
     *
     * @param string           $country_code
     * @param string           $phone_number
     */
    public function findBy($country_code, $phone_number)
    {
        return $this->model
                    ->where('country_code', $country_code)
                    ->where('phone_number', $phone_number)
                    ->first();
    }

    public function get(array $options=null, int $role = Role::USER, $with=[])
    {
        return $this->model->with($with)
            ->hasRole($role)
            ->search($options)
            ->sort($options)
            ->paginate($options['itemsPerPage']);
    }

    public function find(int $id, int $role = Role::USER, $with=[])
    {
        return $this->model
            ->where('id', $id)
            ->hasRole($role)
            ->first();
    }

    public function update(int $id, array $payload)
    {
        // filter out the allowable payload
        $payload = collect($payload);
        $payload = $payload->only($this->model->getFillable())->toArray();
        return $this->model->whereId($id)->update($payload);
    }

    public function storeUser(array $payload, $role = Role::USER)
    {
        $user = $this->store($payload);
        $user->roles()->sync([$role]);

        return $user;
    }

    public function store(array $payload)
    {
        $payload['country_code'] = '91';

        return $this->create($payload);
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}
