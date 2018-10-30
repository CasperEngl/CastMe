<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileDetailsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('profile_details', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();
      $table->text('gallery')->nullable();
      $table->integer('age')->nullable();
      $table->integer('height')->nullable();
      $table->integer('weight')->nullable();
      $table->integer('experience')->nullable();
      $table->integer('pant_size')->nullable();
      $table->integer('shoe_size')->nullable();
      $table->integer('shirt_size')->nullable();
      $table->text('description')->nullable();
      $table->enum('hair_length', ['Bald', 'Balding', 'Short', 'Medium', 'Long', 'Super Long'])->nullable();
      $table->enum('hair_color', ['Black', 'Brown', 'Dark Brown', 'Blonde', 'Dirty Blonde', 'Auburn', 'Red', 'Ginger', 'Platinum', 'White', 'Grey'])->nullable();
      $table->enum('ethnicity', ['African', 'Afro American', 'Asian', 'Caucasian', 'Indian', 'Latino', 'Mediterranean', 'Middle Eastern', 'Pakistanis', 'Scandinavian', 'Spanish', 'Mix'])->nullable();
      $table->enum('eye_color', ['Amber', 'Blue', 'Brown', 'Grey', 'Green', 'Hazel', 'Other'])->nullable();
      $table->text('roles')->nullable();
      $table->integer('user_id')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('profile_details');
  }
}
