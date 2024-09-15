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
        Schema::create('children_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('classe_subject_id');
            $table->foreign('classe_subject_id')->references('id')->on('classe_subject')->cascadeOnDelete();
            $table->float('score1')->nullable();
            $table->float('score2')->nullable();
            $table->float('score3')->nullable();
            $table->float('score4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_subjects');
    }
};
