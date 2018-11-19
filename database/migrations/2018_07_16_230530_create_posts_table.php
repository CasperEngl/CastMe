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
      $table->text('location')->nullable();
      $table->enum('region', ['capital area', 'zealand', 'fyn', 'northern jutland', 'mid jutland', 'south denmark'])->nullable();
      $table->string('banner')->default('placeholder/banner.png');
      $table->boolean('closed')->default(0);
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
