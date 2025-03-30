<?php

namespace Database\Factories;

use App\Models\Joueur;
use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class JoueurFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Joueur::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'equipe_id' => Equipe::inRandomOrder()->first()->id, 
            'numeroMaillot' => $this->faker->unique()->numberBetween(1, 99), 
            'position' => $this->faker->randomElement(['gardien', 'defenseur', 'milieu', 'attaquant']), 
            'statut' => $this->faker->randomElement(['actif', 'suspendu', 'blesse']), 
        ];
    }
}
