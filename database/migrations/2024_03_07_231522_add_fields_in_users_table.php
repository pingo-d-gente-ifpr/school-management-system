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
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->date('birth_date')->required();
            $table->string('document_cpf')->required();
            $table->enum('gender',['feminino','masculino','outros'])->required();
            $table->string('cellphone')->required();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_cellphone')->nullable();
            $table->boolean('status')->required()->default(true);
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('birth_date');
            $table->dropColumn('document_cpf');
            $table->dropColumn('gender');
            $table->dropColumn('cellphone');
            $table->dropColumn('emergency_name');
            $table->dropColumn('emergency_cellphone');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
};
