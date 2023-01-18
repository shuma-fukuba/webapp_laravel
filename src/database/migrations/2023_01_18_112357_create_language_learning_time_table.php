<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_learning_time', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('learning_time_id');
            $table->unsignedBigInteger('language_id');

            $table->foreign('learning_time_id')->references('id')->on('learning_times')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

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
        Schema::dropIfExists('languages');
        Schema::dropIfExists('language_learning_time');
    }
};
