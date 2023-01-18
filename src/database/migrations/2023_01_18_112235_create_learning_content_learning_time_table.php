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
        Schema::create('learning_content_learning_time', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('learning_time_id');
            $table->unsignedBigInteger('learning_content_id');

            $table->foreign('learning_time_id')->references('id')->on('learning_times')->onDelete('cascade');
            $table->foreign('learning_content_id')->references('id')->on('learning_contents')->onDelete('cascade');
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
        Schema::dropIfExists('learning_contents');
        Schema::dropIfExists('learning_content_learning_time');
    }
};
