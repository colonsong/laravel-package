<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->text('name');
                $table->timestamps();
                $table->timestamp('published_at')->nullable();

        });


        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('categorys_id')->constrained();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //移除欄位
            $table->dropForeign('categorys_id');
        });
        Schema::dropIfExists('categorys');


    }
}
