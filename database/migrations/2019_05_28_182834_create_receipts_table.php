<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stead_id')
                ->unsigned()
                ->nullable();
            $table->integer('file_id')->unsigned()->nullable();
            $table->string('date_receipt');
            $table->timestamps();


            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('CASCADE');

            $table->foreign('stead_id')
                ->references('id')
                ->on('steads')
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
        Schema::dropIfExists('receipts');
    }
}
