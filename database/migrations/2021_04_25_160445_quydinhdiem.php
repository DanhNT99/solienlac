<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quydinhdiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quydinhdiem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaDiem', 10)->unique();
            $table->string('MucDanhGia', 5);
            $table->integer('DiemKTDK');
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
        Schema::dropIfExists('quydinhdiem');
    }
}
