<?php

namespace App\Repositories\Contracts;

use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;

interface IApplicationRepository
{
    /**
     * @param array $conditions
     * @param array $relations
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getByConditions(array $conditions, array $relations = [], ?int $page = 1): LengthAwarePaginator;

    /**
     * @param array $conditions
     * @param array $relations
     * @return Application|null
     */
    public function findByConditions(array $conditions, array $relations = []): ?Application;

    /**
     * @param array $data
     * @return Application
     */
    public function store(array $data): Application;

    /**
     * @param Application $application
     * @param array $data
     * @return Application
     */
    public function update(Application $application, array $data): Application;
}
