<?php

namespace Database\Seeders;

use App\Models\ChildrenSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildrenSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChildrenSubject::factory()->count(100)->create();
    }
}
