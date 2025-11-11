<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\ICityRepository;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements ICityRepository
{
    /**
     * @param City $model
     */
    public function __construct(protected City $model)
    {
    }

    /**
     * @param int $skip
     * @return Collection
     */
    public function getByConditions(int $skip = 0): Collection
    {
        return $this->model->newQuery()
            ->skip($skip)
            ->take(20)
            ->get();
    }
}
