<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_news', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('new_id')->unsigned()->nullable();
            $table->integer('img_id')->unsigned()->nullable();

            $table->foreign('img_id')
                ->references('id')
                ->on('files')
                ->onDelete('CASCADE');
            $table->foreign('new_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');

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
        Schema::dropIfExists('images_news');
    }
}
