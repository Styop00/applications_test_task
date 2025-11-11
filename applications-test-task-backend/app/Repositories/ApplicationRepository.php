<?php

namespace App\Repositories;

use App\Models\Application;
use App\Repositories\Contracts\IApplicationRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationRepository implements IApplicationRepository
{
    /**
     * @param Application $model
     */
    public function __construct(protected Application $model)
    {
    }

    /**
     * @param array $conditions
     * @param array $relations
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getByConditions(array $conditions, array $relations = [], ?int $page = 1): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where($conditions)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->paginate(10, ['*'], 'page', $page);
    }

    /**
     * @param array $conditions
     * @param array $relations
     * @return Application|null
     */
    public function findByConditions(array $conditions, array $relations = []): ?Application
    {
        return $this->model->newQuery()
            ->where($conditions)->with($relations)->first();
    }

    /**
     * @param array $data
     * @return Application
     */
    public function store(array $data): Application
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param Application $application
     * @param array $data
     * @return Application
     */
    public function update(Application $application, array $data): Application
    {
        $application->update($data);
        return $application;
    }
}
