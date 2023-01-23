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
        Schema::create('food_coupons', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->integer('participant_id');
            $table->enum('type', ['BREAKFAST', 'LUNCH']);
            $table->integer('day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_coupons');
    }
};
