<?php

namespace Database\Factories;

use App\Models\AdminEquipe;
use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminEquipeFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = AdminEquipe::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'equipe_id' => Equipe::inRandomOrder()->first()->id, 
            'telephone'    => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), 
            'isBanned' => false,

        ];
    }
}
