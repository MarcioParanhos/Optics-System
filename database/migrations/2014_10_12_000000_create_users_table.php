<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('situation_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('companie_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('companie_id')->references('id')->on('profiles');

        });
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@opticssystem.com.br',
                'password' => Hash::make('admin@admin'),
                'situation_id' => 1,
                'profile_id' => 1,
                'companie_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
