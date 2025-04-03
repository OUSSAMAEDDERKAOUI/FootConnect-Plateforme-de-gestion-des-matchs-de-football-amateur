<?php

// database/factories/MatchFactory.php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Equipe;
use App\Models\Arbitre;
use App\Models\Ligue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        return [
            'nombre_journée'=>$this->faker->numberBetween(1, 30),
            'equipe_domicile_id' => Equipe::factory(), 
            'equipe_exterieur_id' => Equipe::factory(),
            'ligue_id'=>1,
            'date_heure' => $this->faker->dateTimeBetween('+1 days', '+2 months'),
            'lieu' => $this->faker->city(),
            'score_domicile' => $this->faker->numberBetween(0, 5),
            'score_exterieur' => $this->faker->numberBetween(0, 5),
            'arbitre_central_id' => Arbitre::factory(),
            'assistant_1_id' => Arbitre::factory(),
            'assistant_2_id' => Arbitre::factory(),
            'delegue_id' => User::factory(),
            'statut' => $this->faker->randomElement(['à venir', 'programmé', 'en cours', 'terminé', 'annulé']),
        ];
    }
}

