<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NienKhoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('nienkhoa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaNK', 10)->unique();
            $table->integer('NamBatDau');
            $table->integer('NamKetThuc');
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
        Schema::dropIfExists('nienkhoa');
    }
}
