<?php

namespace Database\Seeders;

use App\Models\Buteur;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ButeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buteur::factory(2)->create();
    }
}
