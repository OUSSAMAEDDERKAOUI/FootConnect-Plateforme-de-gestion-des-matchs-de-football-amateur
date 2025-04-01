<?php

namespace Database\Factories;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipeFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Equipe::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company, 
            'telephone'       => $this->faker->phoneNumber(),
            'categorie' => $this->faker->randomElement(['Senior']), 
        ];
    }
}
