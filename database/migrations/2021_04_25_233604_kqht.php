<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kqht extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketquahoctap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MucDatDuoc', 5)->nullable();
            $table->integer('Diem')->nullable();
            $table->bigInteger('id_sll')->unsigned()->nullable();
            $table->foreign('id_sll')->references('id')->on('solienlac')->onDelete('cascade');
            $table->bigInteger('id_loaihocky')->unsigned()->nullable();
            $table->foreign('id_loaihocky')->references('id')->on('loaihocky')->onDelete('cascade');
            $table->bigInteger('id_monhoc')->unsigned()->nullable();
            $table->foreign('id_monhoc')->references('id')->on('monhoc')->onDelete('cascade');
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
        Schema::dropIfExists('ketquahoctap');
    }
}
