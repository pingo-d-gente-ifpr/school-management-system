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
        Schema::create('children_frequency', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_classe_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->boolean('attendance')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_frequency');
    }
};
