<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text'];

    public function user(){
        return $this->belongsTo('App\Http\Models\User');
    }

    public function article(){
        return $this->belongsTo('App\Http\Models\Article');
    }
}
