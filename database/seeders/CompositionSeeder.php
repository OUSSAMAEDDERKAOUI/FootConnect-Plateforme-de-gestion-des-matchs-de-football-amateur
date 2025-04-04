<?php

namespace Database\Seeders;

use App\Models\Composition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Composition::factory(11)->create();
    }
}
