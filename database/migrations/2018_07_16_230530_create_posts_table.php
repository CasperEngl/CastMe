<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id');
      $table->string('title');
      $table->text('content')->nullable();
      $table->text('images');
      $table->string('banner')->default('banner.jpg');
      $table->boolean('closed')->default(0);
      $table->boolean('actor')->default(0);
      $table->boolean('dancer')->default(0);
      $table->boolean('entertainer')->default(0);
      $table->boolean('event_staff')->default(0);
      $table->boolean('extra')->default(0);
      $table->boolean('model')->default(0);
      $table->boolean('musician')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('posts');
  }
}
