<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaLop', 10)->unique();
            $table->string('TenLop', 20);
            $table->bigInteger('id_khoi')->unsigned()->nullable();
            $table->bigInteger('id_giaovien')->unsigned()->nullable();
            $table->foreign('id_khoi')->references('id')->on('khoi')->onDelete('cascade');
            $table->foreign('id_giaovien')->references('id')->on('giaovien')->onDelete('set null');
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
        Schema::dropIfExists('lop');
    }
}
