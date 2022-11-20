<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accommodation_guests', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('pic_id');
            $table->integer('accommodation_slot_id');
            $table->integer('accommodation_id');
            $table->string('guest_name');
            $table->enum('guest_gender',['M','F']);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodation_guests');
    }
};
