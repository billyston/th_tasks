<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\Status;
use Exception;
use Illuminate\Support\Facades\DB;

class StatusRepository
{
    /**
     * Store a newly created resource in storage.
     * @param array $request
     * @return Status
     */
    public function store(array $request): Status
    {
        return DB::transaction(function () use ($request)
        {
            $created = Status::query() -> create(
            [
                "name" => data_get( $request, "name"),
                "description" => data_get( $request, "description"),

                'project_id' => data_get( $request, 'project_id'),
            ]);

            throw_if(!$created, Exception::class, "Something went wrong");

            return $created;
        });
    }

    /**
     * Update the specified resource in storage.
     * @param Status $status
     * @param array $request
     * @return array
     */
    public function update(Status $status, array $request): array
    {
        return DB::transaction(function () use ($status, $request)
        {
            $updated = $status -> update(
            [
                'name' => data_get( $request, 'name', $status -> name),
                'description' => data_get( $request, 'description', $status -> description)
            ]);

            throw_if(!$updated, Exception::class, 'Service is unavailable, please retry again later.');

            return $status -> toArray();
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param Status $status
     * @return bool
     */
    public function destroy(Status $status): bool
    {
        return DB::transaction(function () use($status)
        {
            $deleted = $status->forceDelete();
            throw_if(!$deleted, Exception::class, "Cannot delete post.");

            return $deleted;
        });
    }
}
