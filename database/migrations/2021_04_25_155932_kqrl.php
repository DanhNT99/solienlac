<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kqrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketquarenluyen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('XepLoai', 5);
            $table->bigInteger('id_sll')->unsigned();
            $table->foreign('id_sll')->references('id')->on('solienlac')->onDelete('cascade');
            $table->bigInteger('id_hocky')->unsigned();
            $table->foreign('id_hocky')->references('id')->on('hocky')->onDelete('cascade');
            $table->bigInteger('id_hocsinh')->unsigned();
            $table->foreign('id_hocsinh')->references('id')->on('hocsinh')->onDelete('cascade');
            $table->bigInteger('id_pcnl')->unsigned();
            $table->foreign('id_pcnl')->references('id')->on('phamchatnangluc')->onDelete('cascade');
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
        Schema::dropIfExists('ketquarenluyen');
    }
}
