<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
