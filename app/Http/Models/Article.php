<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','body'];
    
    public function comments(){
        return $this->hasMany('App\Http\Models\Comment');
    }

    public function user(){
        return $this->belongsTo('App\Http\Models\User');
    }
}
