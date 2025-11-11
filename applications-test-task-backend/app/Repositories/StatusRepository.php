<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Contracts\IStatusRepository;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository implements IStatusRepository
{
    /**
     * @param Status $model
     */
    public function __construct(protected Status $model)
    {
    }

    /**
     * @return Collection
     */
    public function getByConditions(): Collection
    {
        return $this->model->newQuery()
            ->get();
    }
}
