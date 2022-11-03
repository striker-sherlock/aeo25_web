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
        Schema::create('institution_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade');
            $table->enum('division',['NR','IR']);
            $table->enum('inst_type',['UNI','SHS']);
            $table->string('institution_name');
            $table->string('location');
            $table->string('pic_name');
            $table->string('email');
            $table->string('phone_number');
            $table->integer('informal_letter_sent');
            $table->integer('formal_letter_sent');
            $table->integer('whatsapp_sent');
            $table->boolean('is_valid');
            $table->mediumText('reason');
            $table->mediumText('additional_notes')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_contacts');
    }
};
