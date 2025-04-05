<?php

namespace Database\Factories;

use App\Models\Equipe;
use App\Models\Game;
use App\Models\Joueur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChangementJoueurMatch>
 */
class ChangementJoueurMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id'=>Game::factory(),
            'joueur_sortie_id'=>Joueur::factory(),
            'joueur_entreée_id'=>Joueur::factory(),
            'equipe_id'=>Equipe::factory(),
        ];
    }
}
