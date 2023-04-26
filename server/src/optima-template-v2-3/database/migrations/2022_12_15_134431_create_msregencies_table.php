<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsregenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msregencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provinces_id');
            $table->string('name',255);
            $table->index('provinces_id');
            $table->foreign('provinces_id')->references('id')->on('msprovinces')->onDelete('cascade');
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
        Schema::dropIfExists('msregencies');
    }
}
