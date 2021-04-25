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
            $table->longtext('HocLuc', 200);
            $table->longtext('NhanXet', 200);
            $table->bigInteger('id_truong')->unsigned();
            $table->foreign('id_truong')->references('id')->on('truong')->onDelete('cascade');
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
