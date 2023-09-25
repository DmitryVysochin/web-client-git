<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("connects",function (Blueprint $table){
            $table->integer("idUser")->nullable(false);
            $table->string("ip",255)->nullable(false)->index("ip");
            $table->string("port",255)->default("22");
            $table->string("login",255)->nullable(false);
            $table->string("pathToSite",255)->nullable(false);
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
        Schema::dropIfExists('connects');
    }
}
