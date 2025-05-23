<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'count' => $this->collection->count(),
            ]
        ];
    }
}