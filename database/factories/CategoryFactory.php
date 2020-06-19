<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Scarves', 'Clothing', 'Apparel', 'T-Shirt']),
        'parent_id' => null
    ];
});
