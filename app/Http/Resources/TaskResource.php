<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return
        [
            'type'                          => 'Task',

            'attributes'                    =>
            [
                'resource_id'               => $this -> resource -> resource_id,

                'name'                      => $this -> resource -> name,

                'assigned_to'               => $this -> resource -> user -> name,
                'priority'                  => $this -> resource -> priority -> name,
                'priority_tag'              => $this -> resource -> priority -> color,

                'project'                   => $this -> resource -> status -> project -> name,

                'start_date'                => Carbon::createFromFormat('Y-m-d', $this -> resource -> start_date)->format('m/d/y'),
                'due_date'                  => Carbon::createFromFormat('Y-m-d', $this -> resource -> due_date)->format('m/d/y'),

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],
        ];
    }
}
