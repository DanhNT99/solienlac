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
        Schema::create('hocsinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("MaHS", 10)->unique();
            $table->longtext("HoHS", 100);
            $table->longtext("TenHS", 10);
            $table->string("GioiTinh", 5);
            $table->date("NgaySinh");
            $table->longtext("DiaChi", 200);
            $table->longtext("Hinh", 200);
            
            //khóa ngoại
            $table->bigInteger('id_phuong')->unsigned()->nullable();
            $table->foreign('id_phuong')->references('id')->on('phuong')->onDelete('cascade');
            $table->bigInteger('id_phuhuynh')->unsigned()->nullable();
            $table->foreign('id_phuhuynh')->references('id')->on('phuhuynh')->onDelete('cascade');

            // $table->bigInteger('id_cha')->unsigned()->nullable();
            // $table->bigInteger('id_me')->unsigned()->nullable();
            // $table->foreign('id_cha')->references('id')->on('phuhuynh')->onDelete('set null');
            // $table->foreign('id_me')->references('id')->on('phuhuynh')->onDelete('set null');
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
        Schema::dropIfExists('hocsinh');
    }
}
