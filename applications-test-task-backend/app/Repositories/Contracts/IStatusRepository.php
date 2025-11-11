<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface IStatusRepository
{
    /**
     * @return Collection
     */
    public function getByConditions(): Collection;
}
