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
        Schema::create('merchandise_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('institution')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('phone_number');
            $table->integer('payment_provider_id');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('payment_email')->nullable();
            $table->string('tracking_link')->nullable();
            $table->integer('amount');
            $table->boolean('is_confirmed');
            $table->string('payment_proof');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise_transactions');
    }
};
