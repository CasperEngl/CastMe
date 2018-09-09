<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'avatar' => 'placeholder/avatar.png',
        'remember_token' => str_random(10),
        'stripe_id' => $faker->uuid,
        'card_brand' => $faker->creditCardType,
        'card_last_four' => substr($faker->creditCardNumber, -4)
    ];
});
