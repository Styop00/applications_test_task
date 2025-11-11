<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ICityRepository
{
    /**
     * @param int $skip
     * @return Collection
     */
    public function getByConditions(int $skip=0): Collection;
}
