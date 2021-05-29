<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phanmonhoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phanmonhoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_monhoc')->unsigned()->nullable();
            $table->foreign('id_monhoc')->references('id')->on('monhoc')->onDelete('cascade');
            $table->bigInteger('id_khoi')->unsigned()->nullable();
            $table->foreign('id_khoi')->references('id')->on('khoi')->onDelete('cascade');
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
    }
}
