<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chitietgiadinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chitietgiadinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_hocsinh')->unsigned()->nullable();
            $table->foreign('id_hocsinh')->references('id')->on('hocsinh')->onDelete('CASCADE');
            $table->bigInteger('id_phuhuynh')->unsigned()->nullable();
            $table->foreign('id_phuhuynh')->references('id')->on('phuhuynh')->onDelete('CASCADE');
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
        //
        Schema::dropIfExists('chitietgiadinh');
    }
}
