<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph,
    ];
});
