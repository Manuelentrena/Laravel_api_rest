<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function users(){
      return $this->belongsToMany('App\Http\Models\User')->as('subscriptions')->withTimestamps();
    }

}
