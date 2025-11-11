<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\IRoleRepository;

class RoleRepository implements IRoleRepository
{
    /**
     * @param Role $model
     */
    public function __construct(protected Role $model)
    {
    }

    /**
     * @param string $name
     * @return Role|null
     */
    public function findByName(string $name): ?Role
    {
        return $this->model->newQuery()->where('name', $name)->first();
    }
}
