<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    public function toArray($request)
    {
      return [
      'id' => $this->id,
      'title' => $this->title,
      'body' => $this->body,
      'username' => $this->user->name,
      'category' => $this->category->name,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
    }
}
