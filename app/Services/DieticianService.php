<?php

namespace App\Services;

use App\Models\Dietician;
use App\Models\Role;
use App\Services\UserService;

class DieticianService
{
    protected $model;

    protected $userService;

    /**
     * Constructor function
     *
     * @param User           $model
     */
    public function __construct(Dietician $model, UserService $service)
    {
        $this->model = $model;
        $this->userService = $service;
    }

    public function get(array $options=null, $with=['user'])
    {
        return $this->model->with($with)
            ->search($options)
            ->sort($options)
            ->paginate($options['itemsPerPage'] ?? 100);
    }
    public function find(int $id, $with=['user'])
    {
        return $this->model
            ->where('id', $id)
            ->with($with)
            ->first();
    }

    public function update(int $id, array $data)
    {
        $dietician = $this->model->find($id);

        $this->userService->update($dietician->user_id, $data['user']);

        return $dietician->update(['degree' => $data['degree']]);
    }

    public function store(array $payload)
    {
        $user = $this->userService->store($payload['user']);

        $user->roles()->sync([Role::DIETICIAN]);

        return $this->model->create(['user_id' => $user->id, 'degree' => $payload['degree']]);
    }
}
