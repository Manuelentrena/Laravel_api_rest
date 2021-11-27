<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    public static function boot() {
      parent::boot();

      static::creating(function ($article){
        $article->user_id = Auth::id();
      });
    }

    protected $fillable = ['title','body'];
    
    public function comments(){
      return $this->hasMany('App\Http\Models\Comment');
    }

    public function user(){
      return $this->belongsTo('App\Http\Models\User');
    }
}
