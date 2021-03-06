<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hocky extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hocky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaHK', 10)->unique();
            $table->longtext('TenHK', 20);
            $table->boolean('TrangThai')->default(false);
            $table->bigInteger('id_nienkhoa')->unsigned()->nullable();
            $table->foreign('id_nienkhoa')->references('id')->on('nienkhoa')->onDelete('CASCADE');
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
        Schema::dropIfExists('hocky');
    }
}
