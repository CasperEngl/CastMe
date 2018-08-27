<?php

use App\Conversation;
use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'sender' => rand(1, 2),
        'receiver' => rand(1, 2),
        'content' => $faker->paragraph
    ];
});
