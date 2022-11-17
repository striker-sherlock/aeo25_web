<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competition_scores', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('score_type_id');
            $table->foreign('participant_id')->references('id')->on('competition_participants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('score_type_id')->references('id')->on('score_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('score')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('competition_scores');
    }
};
