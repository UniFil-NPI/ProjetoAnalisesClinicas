<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'phone_number' => $this->faker->phoneNumber(),
            'post_code' => $this->faker->postcode(),
            'street' => $this->faker->streetAddress(),
            'building_number' => $this->faker->buildingNumber(),
            'secondary_address' => $this->faker->secondaryAddress(),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'birth_date' => $this->faker->date(),
            'health_insurance' => $this->faker->word(),
            'biological_sex' => $this->faker->word(),
        ];
    }
}
