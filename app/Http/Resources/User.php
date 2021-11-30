<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Models\Article;

class User extends JsonResource
{
  public function toArray($request)
  {
    /* return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'articles' => Article::where('user_id', '=', $this->id)->get(),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ]; */
  }
}
