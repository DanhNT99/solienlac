<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solienlac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solienlac', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaSLL', 10)->unique();
            // $table->longtext('HocLuc', 200)->nullable();
            // $table->longtext('NhanXet', 200)->nullable();
            $table->bigInteger('id_hocsinh')->unsigned()->nullable();
            $table->foreign('id_hocsinh')->references('id')->on('hocsinh')->onDelete('cascade');
            $table->bigInteger('id_nienkhoa')->unsigned()->nullable();
            $table->foreign('id_nienkhoa')->references('id')->on('nienkhoa')->onDelete('cascade');
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
        Schema::dropIfExists('solienlac');
    }
}
