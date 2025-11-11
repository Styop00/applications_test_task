<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\CityIndexRequest;
use App\Http\Resources\CityResource;
use App\Repositories\Contracts\ICityRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityController extends Controller
{
    /**
     * @param ICityRepository $cityRepository
     */
    public function __construct(protected ICityRepository $cityRepository)
    {
    }

    /**
     * @param CityIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(CityIndexRequest $request): AnonymousResourceCollection
    {
        $cities = $this->cityRepository->getByConditions(
            $request->input('skip', 0)
        );

        return CityResource::collection($cities);
    }
}
