<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'birth_date' => '1980-01-01',
            'document_cpf' => '12345678912',
            'gender' => 'masculino',
            'cellphone' => '99999-9999',
            'emergency_name' => 'Emergency Contact',
            'emergency_cellphone' => '88888-8888',
            'status' => true,
            'role' => 'admin',
        ]);
    }
}
