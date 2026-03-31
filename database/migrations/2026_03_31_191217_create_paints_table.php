<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('color_type'); // base, layer, shade, dry

            $table->unsignedInteger('stock')->default(0);
            $table->decimal('price', 8, 2);

            $table->date('expiration_date')->nullable();

            //Campos extra
            $table->string('finish')->nullable(); // matte, gloss, metallic
            $table->string('code')->nullable(); // código del color
            $table->integer('ml')->nullable(); // mililitros
            $table->boolean('is_active')->default(true); // activo o descontinuado

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paints');
    }
};