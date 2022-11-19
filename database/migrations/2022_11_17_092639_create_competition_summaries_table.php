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
        Schema::create('competition_summaries', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->string('date');
            $table->integer('expected_participants');
            $table->integer('total_participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_summaries');
    }
};
