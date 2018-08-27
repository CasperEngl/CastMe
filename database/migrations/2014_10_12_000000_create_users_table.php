<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('last_name')->nullable();
      $table->string('email')->unique();
      $table->string('password');
      $table->string('avatar')->default('avatar/avatar-256.png');
      $table->string('lang')->nullable();
      $table->enum('role', ['Free', 'Paid', 'Scout', 'Moderator', 'Admin'])->default('Free');
      $table->rememberToken();
      $table->string('stripe_id')->nullable();
      $table->string('card_brand')->nullable();
      $table->string('card_last_four')->nullable();
      $table->timestamp('trial_ends_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
