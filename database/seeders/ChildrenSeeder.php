<?php

namespace Database\Seeders;

use App\Models\Children;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Children::factory()->count(10)->create();
    }
}
