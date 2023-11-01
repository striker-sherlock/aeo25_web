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
        Schema::create('competition_payments', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->integer('pic_id');
            $table->integer('payment_provider_id');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('email')->nullable();
            $table->string('tracking_link')->nullable();
            $table->integer('amount');
            $table->string('payment_proof');
            $table->boolean('is_confirmed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_payments');
    }
};