<?php

namespace App\Repository;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    /**
     * Store a newly created resource in storage.
     * @param array $request
     * @return Task
     */
    public function store(array $request): Task
    {
        return DB::transaction(function () use ($request)
        {
            $created = Task::query() -> create(
            [
                'priority_id' => data_get( $request, 'priority_id'),
                'status_id' => data_get( $request, 'status_id'),
                'user_id' => data_get( $request, 'user_id'),

                'name' => data_get( $request, 'name'),

                'start_date' => data_get( $request, 'start_date'),
                'due_date' => data_get( $request, 'due_date'),

            ]);

            throw_if(!$created, Exception::class, "Something went wrong");

            return $created;
        });
    }

    /**
     * Update the specified resource in storage.
     * @param Task $task
     * @param array $request
     * @return array
     */
    public function update(Task $task, array $request): array
    {
        return DB::transaction(function () use ($task, $request)
        {
            $updated = $task -> update(
            [
                'status_id' => data_get( $request, 'status_id', $task -> status_id),

                'name' => data_get( $request, 'name', $task -> name),
                'start_date' => data_get( $request, 'start_date', $task -> start_date),
                'due_date' => data_get( $request, 'due_date', $task -> due_date),
            ]);
            throw_if(!$updated, Exception::class, 'Service is unavailable, please retry again later.');

            return $task -> toArray();
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     * @return bool
     */
    public function destroy(Task $task): bool
    {
        return DB::transaction(function () use($task)
        {
            $deleted = $task->forceDelete();
            throw_if(!$deleted, Exception::class, "Cannot delete post.");

            return $deleted;
        });
    }
}
