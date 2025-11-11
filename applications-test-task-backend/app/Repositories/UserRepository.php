<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{

    /**
     * @param User $model
     */
    public function __construct(protected User $model)
    {
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->newQuery()->create($data);
    }

    /**
     * @param array $condition
     * @param array|null $relations
     * @return User|null
     */
    public function findByCondition(array $condition, ?array $relations = null): ?User
    {
        return $this->model->newQuery()->where($condition)
            ->when($relations, function ($query) use ($relations) {
                $query->with($relations);
            })
            ->first();
    }

}
