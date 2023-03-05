<?php

namespace App\Repository;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{
    /**
     * Store a newly created resource in storage.
     * @param array $request
     * @return Project
     */
    public function store(array $request): Project
    {
        return DB::transaction(function () use ($request)
        {
            $created = Project::query() -> create(
            [
                "name" => data_get( $request, "name"),
                "description" => data_get( $request, "description")
            ]);

            throw_if(!$created, Exception::class, "Something went wrong");

            return $created;
        });
    }

    /**
     * Update the specified resource in storage.
     * @param Project $project
     * @param array $request
     * @return array
     */
    public function update(Project $project, array $request): array
    {
        return DB::transaction(function () use ($project, $request)
        {
            $updated = $project -> update(
            [
                'name' => data_get( $request, 'name', $project -> name),
                'description' => data_get( $request, 'description', $project -> description)
            ]);

            throw_if(!$updated, Exception::class, 'Service is unavailable, please retry again later.');

            return $project -> toArray();
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param Project $project
     * @return bool
     */
    public function destroy(Project $project): bool
    {
        return DB::transaction(function () use($project)
        {
            $deleted = $project->forceDelete();
            throw_if(!$deleted, Exception::class, "Cannot delete post.");

            return $deleted;
        });
    }
}
