<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_lop')->unsigned();
            $table->foreign('id_lop')->references('id')->on('lop')->onDelete('cascade');
            $table->bigInteger('id_hocsinh')->unsigned();
            $table->foreign('id_hocsinh')->references('id')->on('hocsinh')->onDelete('cascade');
            $table->bigInteger('id_nienkhoa')->unsigned();
            $table->foreign('id_nienkhoa')->references('id')->on('nienkhoa')->onDelete('cascade');
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
        Schema::dropIfExists('hoc');
    }
}
