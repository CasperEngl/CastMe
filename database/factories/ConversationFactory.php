<?php

use App\Conversation;
use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'sender_id' => rand(1, 20),
        'receiver_id' => rand(1, 20),
        'content' => $faker->paragraph
    ];
});
