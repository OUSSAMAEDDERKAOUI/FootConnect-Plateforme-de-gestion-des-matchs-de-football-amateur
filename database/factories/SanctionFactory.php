<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Joueur;
use App\Models\Sanction;
use Illuminate\Database\Eloquent\Factories\Factory;

class SanctionFactory extends Factory
{
    protected $model = Sanction::class;

    public function definition()
    {
        return [
            'game_id' => Game::inRandomOrder()->first()->id,  
            'joueur_id' => Joueur::inRandomOrder()->first()->id,  
            'type' => $this->faker->randomElement(['Carton Jaune', 'Carton Rouge', 'Avertissement']),
            'date_time' => $this->faker->dateTimeThisYear(),  
            'duree' => $this->faker->randomElement(['3 matchs', '2 matchs', '1 matchs']),  
            'note' => $this->faker->optional()->text(),  
        ];
    }
}
