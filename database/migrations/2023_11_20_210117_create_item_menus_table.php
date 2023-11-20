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
        Schema::create('item_menu', function (Blueprint $table) {
            $table->id('id_item_menu');
            $table->string('nombre', 30);
            $table->decimal('precio', 10, 2);
            $table->string('img_item_menu', 250)->nullable();
            $table->tinyInteger('estado')->default(1);
            
            $table->unsignedBigInteger('id_tipo');
            
            $table->foreign('id_tipo')->references('id_tipo')->on('tipo_menu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_menu');
    }
};
