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
            $table->unsignedBigInteger('children_classe_id');
            $table->foreign('children_classe_id')->references('id')->on('children_classe')->cascadeOnDelete();
            $table->date('date');
            $table->boolean('attendance')->default(false);
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
