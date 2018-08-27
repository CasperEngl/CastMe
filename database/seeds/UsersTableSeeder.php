<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->details()->save(App\ProfileDetails::create());
            $user->posts()->save(factory(App\Post::class)->make());
        });
    }
}
