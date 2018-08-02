<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
  return [
    'title'       => $faker->sentence,
    'content'     => $faker->paragraph,
    'images'      => json_encode([$faker->imageUrl()]),
    'actor'       => rand(0, 1),
    'dancer'      => rand(0, 1),
    'entertainer' => rand(0, 1),
    'event_staff' => rand(0, 1),
    'extra'       => rand(0, 1),
    'model'       => rand(0, 1),
    'musician'    => rand(0, 1),
    'user_id'     => function () {
      return factory('App\User')->create()->id;
    }
  ];
});
