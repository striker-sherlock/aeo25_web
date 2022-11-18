<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accommodation_facilities', function (Blueprint $table) {
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->integer('accommodation_id');
            $table->integer('facility_id');
            $table->boolean('is_available');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodation_facilities');
    }
};
