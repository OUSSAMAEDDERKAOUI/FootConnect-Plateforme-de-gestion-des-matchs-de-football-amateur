<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChangementJoueurMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChangementJoueurMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChangementJoueurMatch::factory(23)->create();
    }
}
