<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => mt_rand(1, 3),
        'content' => $faker->text,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
