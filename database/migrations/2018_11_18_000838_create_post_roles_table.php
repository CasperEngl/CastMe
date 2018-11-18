<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->enum('role', ['actor', 'dancer', 'entertainer', 'event staff', 'extra', 'model', 'musician', 'other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_roles');
    }
}
