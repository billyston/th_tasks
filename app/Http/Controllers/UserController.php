<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserTaskResource;
use App\Models\Task;
use App\Models\User;
use App\Traits\apiResponseBuilder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use apiResponseBuilder;

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function get_profile(User $user): JsonResponse
    {
        return $this -> successResponse(new UserResource($user), true, '', Response::HTTP_OK );
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function get_tasks(User $user): JsonResponse
    {
        $tasks = Task::query()->where('user_id', "=", $user->id)->orderBy('status')->get();
        return $this -> successResponse(UserTaskResource::collection($tasks), true, '', Response::HTTP_OK );
    }
}
