<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Loaihocky extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaihocky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaLoaiHK', 10)->unique();
            $table->string('TenLoaiHK', 20);
            $table->bigInteger('id_hocky')->unsigned()->nullable();
            $table->foreign('id_hocky')->references('id')->on('hocky')->onDelete('CASCADE');
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
        Schema::dropIfExists('loaihocky');
    }
}
