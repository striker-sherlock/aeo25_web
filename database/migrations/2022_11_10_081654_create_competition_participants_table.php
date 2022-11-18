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
        Schema::create('competition_participants', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->integer('pic_id');
            $table->integer('competition_slot_id');
            $table->string('competition_id');
            $table->integer('team_id')-> nullable();
            $table->integer('rank_id')->default(0);
            $table->boolean('is_novice_debater')->default(0);
            $table->boolean('is_adjudicator')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('gender',['Male','Female']);
            $table->string('birth_date');
            $table->string('profile_picture');
            $table->string('is_vegetarian');
            $table->string('additional_notes')->nullable();
            $table->boolean('is_attend')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_participants');
    }
};
