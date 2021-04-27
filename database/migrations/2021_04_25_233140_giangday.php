<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Giangday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giangday', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_giaovien')->unsigned()->nullable();
            $table->foreign('id_giaovien')->references('id')->on('giaovien')->onDelete('set null');
            $table->bigInteger('id_monhoc')->unsigned()->nullable();
            $table->foreign('id_monhoc')->references('id')->on('monhoc')->onDelete('set null');
            $table->bigInteger('id_lop')->unsigned()->nullable();
            $table->foreign('id_lop')->references('id')->on('lop')->onDelete('set null');
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
        Schema::dropIfExists('giangday');
    }
}
