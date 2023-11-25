<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        DB::table('profiles')->insert([
            [
                'name' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Consulta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colaborador',
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
        Schema::dropIfExists('profiles');
    }
};
