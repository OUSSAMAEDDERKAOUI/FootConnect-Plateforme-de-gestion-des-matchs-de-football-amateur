<?php

namespace Database\Seeders;

use App\Models\Entraineur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class EntraineurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entraineur::factory(10)->create();
    }
}
