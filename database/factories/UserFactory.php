<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prenom'      => $this->faker->firstName(),
            'nom'           => $this->faker->lastName(),
            'nationalite'     => $this->faker->randomElement(['marocaine', 'française', 'algérienne', 'tunisienne']),
            'date_naissance'   => $this->faker->date(),
            'telephone'       => $this->faker->phoneNumber(),
            'photo'         => $this->faker->imageUrl(640, 480, 'people'), 
            'isBanned' => false,
            'email'           => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(), 
            'password'          => bcrypt('password'), 
            'role'              => $this->faker->randomElement(['joueur', 'arbitre', 'entraineur', 'medecin']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
