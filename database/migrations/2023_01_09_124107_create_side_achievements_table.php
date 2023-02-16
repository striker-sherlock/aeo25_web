<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('side_achievements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('competition_participants')->onDelete('cascade');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('side_achievements');
    }
};
