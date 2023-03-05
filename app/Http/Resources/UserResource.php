<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type'                          => 'User',

            'attributes'                    =>
            [
                'resource_id'               => $this -> resource -> resource_id,

                'name'                      => $this -> resource -> name,
                'emai'                      => $this -> resource -> email,

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],
        ];
    }
}
