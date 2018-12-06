<?php

use Faker\Generator as Faker;

$factory->define(App\Animes::class, function (Faker $faker) {
    return [
        'anime_id' => $faker->randomNumber(),
        'anime_title' => $faker->title(),
        'anime_airing_status' => $faker->numberBetween(1, 3),
        'anime_num_episodes' => $faker->randomNumber(),
        'num_watched_episodes' => $faker->randomNumber(),
        'anime_start_date_string' => now()->subMonth(),
        'anime_end_date_string' => now()->addMonth(3),
        'score' => $faker->numberBetween(0, 10)
    ];
});
