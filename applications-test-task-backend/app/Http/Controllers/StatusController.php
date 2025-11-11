<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Repositories\Contracts\IStatusRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusController extends Controller
{
    /**
     * @param IStatusRepository $statusRepository
     */
    public function __construct(protected IStatusRepository $statusRepository)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $cities = $this->statusRepository->getByConditions();

        return StatusResource::collection($cities);
    }
}
