<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('series_id')->nullable();
            $table->string('title');
            $table->integer('epn');
            $table->text('content')->nullable();
            $table->string('upvideo')->nullable();
            $table->string('videxten')->nullable();
            $table->text('watchserversname')->nullable();
            $table->text('watchserverscode')->nullable();
            $table->text('downserversname')->nullable();
            $table->text('downserverslink')->nullable();
            $table->string('downloadoption');
            $table->string('image');
            $table->string('image_src');
            $table->intger('views')->nullable();
            $table->string('tags')->nullable();
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
        Schema::dropIfExists('posts');
    }
}