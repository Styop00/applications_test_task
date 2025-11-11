<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\IRoleRepository;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param IUserRepository $userRepository
     * @param IRoleRepository $roleRepository
     */
    public function __construct(
        protected IUserRepository $userRepository, protected IRoleRepository $roleRepository
    )
    {

    }

    /**
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user()->load('roles'));
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userRepository->store($data);

        $role = $this->roleRepository->findByName(Role::ROLE_USER);
        $user->roles()->sync($role->id);

        $token = $this->generateAuthToken($user);

        return response()->json([
            'token' => $token,
            'user'  => new UserResource($user->load('roles')),
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userRepository->findByCondition(['email' => $data['email']], ['roles']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                "success" => 0,
                "type"    => "error",
                "message" => [
                    'Unauthorized'
                ]
            ], 401);
        }

        $token = $this->generateAuthToken($user);

        return response()->json([
            'token' => $token,
            'user'  => new UserResource($user),
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Generate authentication token for the user.
     */
    private function generateAuthToken(User $user): string
    {
        $createdToken = $user->createToken('authToken');

        return $createdToken->plainTextToken;
    }
}
