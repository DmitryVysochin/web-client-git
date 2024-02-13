<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForConnect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('connects', function (Blueprint $table) {
            $table->string("loginGit",255)->nullable(false);
            $table->string("passwordGit",255)->nullable(false);
            $table->string("nameConnect",255)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connects', function (Blueprint $table) {
            $table->dropColumn('loginGit');
            $table->dropColumn('passwordGit');
            $table->dropColumn('nameConnect');
        });
    }
}
