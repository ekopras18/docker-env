<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsvillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msvillages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('districts_id');
            $table->string('name',255);
            $table->index('districts_id');
            $table->foreign('districts_id')->references('id')->on('msdistricts')->onDelete('cascade');
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
        Schema::dropIfExists('msvillages');
    }
}
