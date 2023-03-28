<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recepciones', function (Blueprint $table) {
            $table->string('lastname')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('recepciones')->whereNull('lastname')->update(['lastname' => '']);
        Schema::table('recepciones', function (Blueprint $table) {
            $table->string('lastname', 200)->nullable(false)->change();
        });
    }
};
