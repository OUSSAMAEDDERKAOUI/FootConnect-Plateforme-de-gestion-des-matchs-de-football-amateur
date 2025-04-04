<?php

namespace Database\Factories;

use App\Models\Composition;
use App\Models\Game;
use App\Models\Joueur;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompositionFactory extends Factory
{
    protected $model = Composition::class;

    public function definition()
    {
        return [
            'game_id' => Game::factory(),
            'joueur_id' => Joueur::factory(),
            'statut' => $this->faker->randomElement(['titulaire', 'remplaçant']),
        ];
    }
}
