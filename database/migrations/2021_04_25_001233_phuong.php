<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phuong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phuong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaPhuong', 10)->unique();
            $table->string('TenPhuong', 50);
            $table->bigInteger('id_tinh')->unsigned();
            $table->foreign('id_tinh')->references('id')->on('tinh');
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
        Schema::dropIfExists('phuong');
    }
}
