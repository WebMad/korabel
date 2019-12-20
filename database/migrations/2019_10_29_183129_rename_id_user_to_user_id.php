<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIdUserToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_roles', function(Blueprint $table) {
            $table->renameColumn('id_user', 'user_id');
            $table->renameColumn('id_role', 'role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_roles', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id_user');
            $table->renameColumn('role_id', 'id_role');
        });
    }
}
