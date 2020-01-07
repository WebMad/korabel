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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stead_id')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
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
