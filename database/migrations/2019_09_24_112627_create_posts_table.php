<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id'); //bigint unsigned auto_increment primary key
            $table->string('title', 255); //varchar(255)
            $table->text('content'); //text
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('slug');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->timestamps(); // created_at:timestamp + update_at:timestamp

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
    }
}
