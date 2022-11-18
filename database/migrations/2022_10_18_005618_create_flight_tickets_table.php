<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flight_tickets', function (Blueprint $table) {
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->integer('pic_id');
            $table->enum('type', ['DEPARTURE', 'ARRIVAL']);
            $table->string('airline_name');
            $table->string('flight_time');
            $table->text('ticket_proof');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flight_registrations');
    }
};
