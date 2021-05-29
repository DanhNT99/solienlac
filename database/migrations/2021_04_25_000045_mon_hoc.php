<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Monhoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Monhoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaMH', 10)->unique();
            $table->string('TenMH', 50);
            $table->boolean('ChoPhepNhapDiem');
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
        Schema::dropIfExists('monhoc');
    }
}
