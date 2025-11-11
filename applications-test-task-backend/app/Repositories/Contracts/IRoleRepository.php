<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

interface IRoleRepository
{
    /**
     * @param string $name
     * @return Role|null
     */
    public function findByName(string $name): ?Role;
}
