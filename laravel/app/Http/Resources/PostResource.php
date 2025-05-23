<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->when($request->is('api/posts/*'), $this->content),
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'image_url' => $this->getFirstMediaUrl('post_images'),
        ];
    }
}