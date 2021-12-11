<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Article;
use Faker\Generator as Faker;


$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'category_id' => $faker->numberBetween(1,3),
        'image' => 'https://picsum.photos/400/300',
        /* 'image' => 'articles/' . $faker->image(public_path('storage\articles'), 400, 300, null, false), */
    ];
});
