<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NhanXet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanxet', function (Blueprint $table) {
            $table->id();
            $table->longText('HocLuc', 100)->nullable();
            $table->longText('NhanXet', 100)->nullable();
            $table->bigInteger('id_sll')->unsigned();
            $table->foreign('id_sll')->references('id')->on('solienlac')->onDelete('CASCADE');
            $table->bigInteger('id_hocky')->unsigned();
            $table->foreign('id_hocky')->references('id')->on('hocky')->onDelete('CASCADE');
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
        Schema::dropIfExists('nhatxet');
    }
}
