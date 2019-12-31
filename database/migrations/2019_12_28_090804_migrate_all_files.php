<?php

use App\Documents;
use App\Files;
use App\FileType;
use App\Receipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateAllFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //images_news
        Schema::table('images_news', function (Blueprint $table) {
            $table->addColumn('integer', 'img_id')->unsigned()->nullable();

            $table->foreign('img_id')
                ->references('id')
                ->on('files')
                ->onDelete('CASCADE');
        });

        $images = DB::table('images_news')->get();

        foreach ($images as $image) {
            $file = Files::create([
                'name' => 'картинка',
                'url' => $image->img_url,
                'file_type_id' => FileType::IMAGE,
            ]);
            $image->img_id = $file->id;
            $image->save();
        }

        Schema::table('images_news', function (Blueprint $table) {
            $table->removeColumn('img_url');
        });

        //receipts
        Schema::table('receipts', function (Blueprint $table) {
            $table->addColumn('integer', 'file_id')->unsigned()->nullable();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('CASCADE');
        });

        $receipts = Receipt::all();

        foreach ($receipts as $receipt) {
            $file = Files::create([
                'name' => 'квитанция',
                'url' => $receipt->file,
                'file_type_id' => FileType::RECEIPT
            ]);

            $receipt->file_id = $file->id;
            $receipt->save();
        }

        Schema::table('receipts', function (Blueprint $table) {
            $table->removeColumn('file');
        });

        //documents
        Schema::table('documents', function (Blueprint $table) {
            $table->addColumn('integer', 'file_id')->unsigned()->nullable();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('cascade');
        });

        $documents = Documents::all();

        foreach ($documents as $document) {
            switch ($document->type) {
                case 'protocol':
                    $type = FileType::PROTOCOL_MEETING;
                    break;
                case 'pattern':
                    $type = FileType::APPLICATION_TEMPLATE;
                    break;
                default:
                    $type = FileType::DOCUMENT;
            }
            $file = Files::create([
                'name' => $document->name,
                'url' => $document->file,
                'file_type_id' => $type,
            ]);

            $document->file_id = $file->id;
            $document->save();
        }
        Schema::table('documents', function (Blueprint $table) {
            $table->removeColumn('file');
            $table->removeColumn('name');
            $table->removeColumn('img');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
