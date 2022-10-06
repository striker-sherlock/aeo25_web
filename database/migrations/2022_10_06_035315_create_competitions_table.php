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
        Schema::create('competitions', function (Blueprint $table) {
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('id', 5)->primary();
            $table->string('name');
            $table->integer('fixed_quota');
            $table->integer('temp_quota');
            $table->integer('price');
            $table->longText('content')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('need_submission');
            $table->boolean('need_team');
            $table->integer('max_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
};
