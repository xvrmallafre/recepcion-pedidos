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
        Schema::create('recepciones', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('lastname', 200);
            $table->string('email', 200)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->boolean('has_material')->default(false);
            $table->text('material')->nullable();
            $table->text('description')->nullable();
            $table->text('observations')->nullable();
            $table->enum('status', ['received', 'done', 'delivered', 'rejected'])->default('received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepciones');
    }
};
