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
        Schema::create('bundle_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_id')->constrained()->cascadeOnDelete();
            
            // Polymorphic relation to either Paint or Figure
            $table->string('sellable_type');
            $table->unsignedBigInteger('sellable_id');
            
            $table->integer('quantity')->default(1);
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
        Schema::dropIfExists('bundle_items');
    }
};
