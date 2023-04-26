<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msdistricts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regencies_id');
            $table->string('name',255);
            $table->index('regencies_id');
            $table->foreign('regencies_id')->references('id')->on('msregencies')->onDelete('cascade');
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
        Schema::dropIfExists('msdistricts');
    }
}
