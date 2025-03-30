<?php

namespace Database\Factories;

use App\Models\AdminLigue;
use App\Models\Ligue;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminLigueFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = AdminLigue::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ligue_id' => Ligue::inRandomOrder()->first()->id, 
            'email' => $this->faker->unique()->safeEmail, 
            'password' => bcrypt('password123'), 
        ];
    }
}
