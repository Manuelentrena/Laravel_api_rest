<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Models\User;
use App\Http\Models\Article;

class Comment extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'text' => $this->text,
          'userLink' => '/api/v1/users/' . $this->user_id,
          'articleLink' => 'api/v1/article/' . $this->article_id,
          'user' => User::where('id', '=', $this->user_id)->first(),
          'article' => Article::where('id', '=', $this->article_id)->first(),
          'created_at' => $this->created_at,
          'update_at' => $this->updated_at,
        ];
    }
}
