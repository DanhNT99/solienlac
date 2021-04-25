<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phuhuynh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phuhuynh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("MaPH", 10)->unique();
            $table->longtext("HoTenPH", 100);
            $table->longtext("NgheNghiep", 100);
            $table->longtext("NoiLamViec", 100);
            $table->string("GioiTinh", 5);
            $table->string("SoDT", 13);
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
        Schema::dropIfExists('phuhuynh');
    }
}
