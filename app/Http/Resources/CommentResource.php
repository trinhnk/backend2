<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
			'id'            => $this->id,
            'content'       => $this->content,
            'article'       => $this->article,
            'user'          => $this->user,
            'created_at'    => $this->created_at->diffForHumans(),
            'updated_at'    => $this->updated_at->diffForHumans(),
        ];
    }
}
