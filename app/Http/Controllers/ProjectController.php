<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\ProjectRepository;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    use apiResponseBuilder, Relatives;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $project = Project::query() -> get();
        if ( $this -> loadRelationships() ) { $project -> load( $this -> relationships ); }
        return $this -> successResponse(ProjectResource::collection($project), true, '', Response::HTTP_OK );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param ProjectRepository $repository
     * @return JsonResponse
     */
    public function store(Request $request, ProjectRepository $repository): JsonResponse
    {
        $created = $repository -> store($request -> only(['name', 'description']));
        return $this -> successResponse(new ProjectResource($created), true, 'Project created', Response::HTTP_CREATED );
    }

    /**
     * Display the specified resource.
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        if ( $this -> loadRelationships() ) { $project -> load( $this -> relationships ); }
        return $this -> successResponse(new ProjectResource($project), true, '', Response::HTTP_OK );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Project $project
     * @param ProjectRepository $repository
     * @return JsonResponse
     */
    public function update(Project $project, Request $request, ProjectRepository $repository): JsonResponse
    {
        $repository -> update($project, $request -> only(['name', 'description']));
        return $this -> successResponse(new ProjectResource($project), true, 'Project updated', Response::HTTP_OK );
    }

    /**
     * Remove the specified resource from storage.
     * @param Project $project
     * @param ProjectRepository $repository
     * @return JsonResponse|ProjectResource
     */
    public function destroy(Project $project, ProjectRepository $repository): JsonResponse|ProjectResource
    {
        $repository -> destroy( $project );
        return $this -> successResponse( array(), true, 'Project deleted.', Response::HTTP_NO_CONTENT );
    }
}
