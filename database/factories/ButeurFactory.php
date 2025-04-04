<?php

namespace Database\Factories;

use App\Models\Buteur;
use App\Models\Game; 
use App\Models\Joueur; 
use Illuminate\Database\Eloquent\Factories\Factory;

class ButeurFactory extends Factory
{
    protected $model = Buteur::class;

    public function definition()
    {
        return [
            'game_id' => Game::factory(), 
            'joueur_id' => Joueur::factory(), 
            'minute' => $this->faker->time(), 
        ];
    }
}
