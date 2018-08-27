<?php

use App\Conversation;
use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'sender_id' => rand(1, 2),
        'receiver_id' => rand(1, 2),
        'content' => $faker->paragraph
    ];
});
