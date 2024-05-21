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
            'cpf' => fake()->ssn(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'post_code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'building_number' => fake()->buildingNumber(),
            'secondary_address' => fake()->secondaryAddress(),
            'neighborhood' => fake()->streetName(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'birth_date' => fake()->dateTimeThisCentury(),
            'health_insurance' => fake()->randomElement(['Unimed', 'Hausey', 'Hospitalar', 'SUS', 'Sulamerica', 'Cassi']),
            'biological_sex' => fake()->randomElement(['feminino', 'masculino']),

            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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
