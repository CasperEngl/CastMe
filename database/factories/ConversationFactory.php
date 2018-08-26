<?php

use App\Conversation;
use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'sender_id' => 1,
        'receiver_id' => 2,
        'content' => $faker->paragraph
    ];
});
