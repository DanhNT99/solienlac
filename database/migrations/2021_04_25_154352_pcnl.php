<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pcnl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phamchatnangluc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MaPCNL', 10)->unique();
            $table->string('TenPCNL', 100);
            $table->boolean();
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
        Schema::dropIfExists('phamchatnangluc');
    }
}
