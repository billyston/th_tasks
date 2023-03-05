<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Repository\StatusRepository;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    use apiResponseBuilder, Relatives;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $statuses = Status::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); }) -> get();
        return $this -> successResponse(StatusResource::collection($statuses), true, '', Response::HTTP_OK );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param StatusRepository $repository
     * @return JsonResponse
     */
    public function store(Request $request, StatusRepository $repository): JsonResponse
    {
        $created = $repository -> store($request -> only(['name', 'description', 'project_id']));
        if ( $this -> loadRelationships() ) { $created -> load( $this -> relationships ); }
        return $this -> successResponse(new StatusResource($created), true, 'Status created', Response::HTTP_CREATED );
    }

    /**
     * Display the specified resource.
     * @param Status $status
     * @return JsonResponse
     */
    public function show(Status $status): JsonResponse
    {
        if ( $this -> loadRelationships() ) { $status -> load( $this -> relationships ); }
        return $this -> successResponse(new StatusResource($status), true, '', Response::HTTP_OK );
    }

    /**
     * Update the specified resource in storage.
     * @param Status $status
     * @param Request $request
     * @param StatusRepository $repository
     * @return JsonResponse
     */
    public function update(Status $status, Request $request, StatusRepository $repository): JsonResponse
    {
        $repository -> update($status, $request -> only(['name', 'description']));
        return $this -> successResponse(new StatusResource($status), true, 'Status updated', Response::HTTP_OK );
    }

    /**
     * Remove the specified resource from storage.
     * @param Status $status
     * @param StatusRepository $repository
     * @return JsonResponse|StatusResource
     */
    public function destroy(Status $status, StatusRepository $repository): JsonResponse|StatusResource
    {
        $repository -> destroy( $status );
        return $this -> successResponse( array(), true, 'Status deleted.', Response::HTTP_NO_CONTENT );
    }
}
