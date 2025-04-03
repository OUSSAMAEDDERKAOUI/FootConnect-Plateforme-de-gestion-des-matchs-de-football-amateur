<?php

namespace Database\Factories;
use App\Models\User;

use App\Models\Delegue;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelegueFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Delegue::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'numero_accreditation' => $this->faker->unique()->numerify('ACR-####'), 
            'niveau' => $this->faker->randomElement(['régional', 'national', 'international']), 
            'experience' => $this->faker->sentence(), 
        ];
    }
}
