<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => $faker->numberBetween(1,20),

    ];
});
