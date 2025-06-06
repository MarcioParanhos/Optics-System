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
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('frame_ref');
            $table->string('price');
            $table->string('os')->nullable();
            $table->unsignedBigInteger('situation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('description')->nullable();
            $table->date('release_date_of');

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frames');
    }
};
