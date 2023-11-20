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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id('id_vehiculo');
            $table->string('placa', 10);
            $table->string('color', 15);
            $table->string('img_vehiculo', 250)->nullable();
            $table->tinyInteger('estado')->default(1);
            
            $table->unsignedBigInteger('id_tipo_vehiculo');
            $table->unsignedBigInteger('id_repartidor')->nullable();
            
            $table->foreign('id_tipo_vehiculo')->references('id_tipo_vehiculo')->on('tipo_vehiculo');
            $table->foreign('id_repartidor')->references('id_repartidor')->on('repartidor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
