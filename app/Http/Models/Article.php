<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','body'];
    //Esto es lo que me pidio el jefe
}
