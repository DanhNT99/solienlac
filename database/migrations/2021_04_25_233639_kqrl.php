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
            $table->bigInteger('id_sll')->unsigned()->nullable();
            $table->foreign('id_sll')->references('id')->on('solienlac')->onDelete('cascade');
            $table->bigInteger('id_loaihocky')->unsigned()->nullable();
            $table->foreign('id_loaihocky')->references('id')->on('loaihocky')->onDelete('cascade');
            $table->bigInteger('id_pcnl')->unsigned()->nullable();
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
