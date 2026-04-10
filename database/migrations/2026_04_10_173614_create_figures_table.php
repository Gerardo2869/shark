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
        Schema::create('figures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('faction')->nullable();
            $table->string('unit_type')->nullable(); // e.g. HQ, Troops
            $table->string('material')->nullable(); // Plastic, Resin, Metal
            $table->string('condition')->nullable(); // New on Sprue, Assembled
            $table->string('base_size')->nullable(); // e.g. 32mm
            $table->integer('points')->nullable(); // Game points
            
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('figures');
    }
};
