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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete(); // Link to the main sale
            
            // Polymorphic relation to either Paint or Figure
            $table->string('sellable_type');
            $table->unsignedBigInteger('sellable_id');
            
            $table->integer('quantity'); // How many units were sold
            $table->decimal('unit_price', 10, 2); // Price per unit at the time of sale
            $table->decimal('subtotal', 10, 2); // Calculated: quantity * unit_price
            
            $table->timestamps();

            // Index for faster polymorphic lookups
            $table->index(['sellable_type', 'sellable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
