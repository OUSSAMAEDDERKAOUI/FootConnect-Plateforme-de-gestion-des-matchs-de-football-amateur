<?php

namespace Database\Factories;

use App\Models\Arbitre;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArbitreFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Arbitre::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_accreditation' => $this->faker->unique()->numerify('ACR-####'), 
            'niveau' => $this->faker->randomElement(['régional', 'national', 'international']), 
            'poste' => $this->faker->randomElement(['arbitre central', 'assistant', 'vidéo']), 
            'experience' => $this->faker->sentence(), 
        ];
    }
}
