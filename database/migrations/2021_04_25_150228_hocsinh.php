<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hocsinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('hocsinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("MaHS", 10)->unique();
            $table->longtext("HoTenHS", 100);
            $table->string("GioiTinh", 5);
            $table->date("NgaySinh");
            $table->longtext("DiaChi", 200);
            $table->longtext("Hinh", 200);
            $table->bigInteger('id_phuong')->unsigned();
            $table->foreign('id_phuong')->references('id')->on('phuong');
            $table->bigInteger('id_cha')->unsigned();
            $table->bigInteger('id_me')->unsigned();
            $table->foreign('id_cha')->references('id')->on('phuhuynh');
            $table->foreign('id_me')->references('id')->on('phuong');
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
        Schema::dropIfExists('hocsinh');
    }
}
