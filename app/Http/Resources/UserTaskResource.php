<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTaskResource extends JsonResource
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
                'status'                    => $this -> resource -> status,

                'name'                      => $this -> resource -> name,
                'priority'                  => $this -> resource -> priority,

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],
        ];
    }
}
