<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RapportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'game_id' => \App\Models\Game::factory(),
            'reserves' => $this->faker->optional()->text(200),
            'observations' => $this->faker->optional()->text(300),
        ];
    }
}
