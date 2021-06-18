<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nhapdiemgiuaky extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nhapdiemgiuaky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaND', 10)->unique();
            $table->bigInteger('id_khoi');
            $table->bigInteger('id_monhoc');
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
        Schema::dropIfExists('nhapdiemgiuaky');
    }
}