<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actividades_transporte', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->integer('id_act_tra')->default(0); // ID de actividad de transporte
            $table->string('nom_con'); // Nombre del contratista
            $table->string('num_ide')->unique(); // Número de identificación
            $table->string('no_act_tra')->unique(); // Número de actividad de transporte
            $table->date('fec_pub'); // Fecha de publicación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_s_vmovilidads');
    }
};
