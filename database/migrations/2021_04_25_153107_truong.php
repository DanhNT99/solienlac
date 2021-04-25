<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Truong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaTruong', 10)->unique();
            $table->string('TenTruong', 200);
            $table->string('Diachi', 200);
            $table->string("SoDT", 13);
            $table->bigInteger('id_phuong')->unsigned();
            $table->foreign('id_phuong')->references('id')->on('phuong');
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
        Schema::dropIfExists('truong');
    }
}
