<?php

namespace Database\Factories;

use App\Models\Medecin;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MedecinFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Medecin::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), 

            'licence' => $this->faker->unique()->bothify('???-####-???'), 
            'specialite' => $this->faker->randomElement(['Traumatologie', 'Physiothérapie', 'Médecine générale']), 
            'statut' => $this->faker->randomElement(['actif', 'suspendu']), 
        ];
    }
}
