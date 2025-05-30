<?php

namespace Database\Factories;

use App\Models\Ligue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LigueFactory extends Factory
{
    // Le modèle associé à la factory
    protected $model = Ligue::class;

    /**
     * Définir l'état de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_ligue' => $this->faker->company, 
            'region' => $this->faker->word, 
            
        ];
    }
}
