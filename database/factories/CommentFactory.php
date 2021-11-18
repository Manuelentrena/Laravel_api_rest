<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph,
        'article_id' => $faker->numberBetween(1,50),
        'user_id' => $faker->numberBetween(1,20),
    ];
});
