<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Models\Article;
use Illuminate\Support\Facades\Auth;

class User extends JsonResource
{

  protected $token;

  public function __construct($resource, $token = null){
    parent::__construct($resource);
    $this->token = $token;
  }

  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      //'userable' => $this->userable,
      $this->merge($this->userable),
      //'type' => $this->when(Auth::user()->userable_type == 'App\Http\Models\Admin','Admin', 'Writer'),
      //'credential_number' => $this->when(Auth::user()->userable_type == 'App\Http\Models\Admin',$this->userable->credential_number),
      //'editorial' => $this->when(Auth::user()->userable_type == 'App\Http\Models\Writer',$this->userable->editorial),
      //'short_bio' => $this->when(Auth::user()->userable_type == 'App\Http\Models\Writer',$this->userable->short_bio),
      'articles' => Article::where('user_id', '=', $this->id)->get(),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'token' => $this->when($this->token,$this->token),
    ];
  }
}
