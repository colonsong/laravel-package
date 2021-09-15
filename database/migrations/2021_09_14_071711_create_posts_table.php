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

            $table->string('title', 60);
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
             $table->foreignId('user_id')
                      ->constrained()
                      ->onUpdate('cascade')
                      ->onDelete('cascade');

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
