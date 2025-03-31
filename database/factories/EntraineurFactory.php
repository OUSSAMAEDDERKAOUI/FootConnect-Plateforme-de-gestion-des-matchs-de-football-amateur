<?php

namespace Database\Factories;

use App\Models\Entraineur;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntraineurFactory extends Factory
{
    protected $model = Entraineur::class;

    public function definition()
    {
        return [
            'experience' => $this->faker->word, 
            'licence' => $this->faker->unique()->word, 
            'role_entraineur' => $this->faker->randomElement(['principal', 'adjoint', 'préparateur physique']), 
            'statut' => $this->faker->randomElement(['actif', 'suspendu']), 
        ];
    }
}
