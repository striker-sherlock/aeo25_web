<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('accommodation_slot_details', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('pic_id');
            $table->string('accommodation_id');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->string('special_req')->nullable();
            $table->integer('quantity');
            $table->integer('payment_id')->nullable();
            $table->boolean('is_confirmed');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodation_slots');
    }
};
