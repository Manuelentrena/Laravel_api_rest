<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model {

  protected $fillable = ['editorial','short_bio'];
  public $timestamps = false;

  public function user()
  {
    return $this->morphOne('App\Http\Models\User', 'userable');
  }
}
