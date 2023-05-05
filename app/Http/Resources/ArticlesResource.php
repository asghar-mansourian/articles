<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'picture' => url('/') . '/storage/articles/' . basename($this->picture),
            'author_name' => $this->author->name,
            'content' => $this->content,
            'vote' => $this->votes()->selectRaw('SUM(type = "like") as like_count, SUM(type = "dislike") as dislike_count')->first(),
            'view' => $this->view,
        ];
    }
}
