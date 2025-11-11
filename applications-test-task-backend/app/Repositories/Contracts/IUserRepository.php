<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface IUserRepository
{
    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User;

    /**
     * @param array $condition
     * @param array|null $relations
     * @return User|null
     */
    public function findByCondition(array $condition, ?array $relations = null): ?User;
}
