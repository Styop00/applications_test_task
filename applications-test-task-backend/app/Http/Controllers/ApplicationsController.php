<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\ApplicationIndexRequest;
use App\Http\Requests\Application\CreateApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Repositories\Contracts\IApplicationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApplicationsController extends Controller
{
    /**
     * @param IApplicationRepository $applicationRepository
     */
    public function __construct(protected IApplicationRepository $applicationRepository)
    {
    }

    /**
     * @param ApplicationIndexRequest $request
     * @return ResourceCollection
     * @throws \Throwable
     */
    public function index(ApplicationIndexRequest $request): ResourceCollection
    {

        $applications = $this->applicationRepository->getByConditions(
            [],
            ['city', 'status'],
            $request->input('page', 1)
        );

        return $applications->toResourceCollection();
    }

    /**
     * @param CreateApplicationRequest $request
     * @return ApplicationResource
     */
    public function store(CreateApplicationRequest $request): ApplicationResource
    {
        $data = $request->validated();
        $application = auth()->user()->applications()->create($data);

        return new ApplicationResource($application);

    }

    /**
     * @param int $id
     * @return JsonResponse|ApplicationResource
     */
    public function show(int $id): JsonResponse|ApplicationResource
    {
        $application = $this->applicationRepository->findByConditions(
            ['id' => $id],
            ['city', 'status', 'author']
        );

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        return new ApplicationResource($application);
    }

    /**
     * @param UpdateApplicationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateApplicationRequest $request, int $id): JsonResponse
    {
        $application = $this->applicationRepository->findByConditions(
            ['id' => $id],
        );

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        if (!auth()->user()->can('update', $application)) {
            return response()->json(['message' => 'Update operation not allowed'], 403);
        }

        $data = $request->validated();
        $updatedApplication = $this->applicationRepository->update($application, $data);

        return response()->json(new ApplicationResource($updatedApplication), 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $application = $this->applicationRepository->findByConditions(
            ['id' => $id],
        );

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        if (!auth()->user()->can('forceDelete', $application)) {
            return response()->json(['message' => 'Force Delete operation not allowed'], 403);
        }

        $application->delete();

        return response()->json(['success' => true], 204);
    }
}
