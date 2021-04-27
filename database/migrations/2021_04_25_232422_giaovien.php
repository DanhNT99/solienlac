<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Giaovien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaovien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("MaGV", 10)->unique();
            $table->longtext("HoTenGV", 100);
            $table->string("GioiTinh", 5);
            $table->date("NgaySinh");
            $table->longtext("DiaChi", 200);
            $table->string("SoDT", 13);
            $table->longtext("Hinh", 200);
            $table->string('TaiKhoan', 13);
            $table->longtext('MatKhau', 50);
            $table->bigInteger('id_phuong')->unsigned()->nullable();
            $table->foreign('id_phuong')->references('id')->on('phuong')->onDelete('set null');
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
        Schema::dropIfExists('giaovien');
    }
}
