<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_name' => fake()->name(),
            'doctor_name' => fake()->name(),
            'lab' => fake()->address(),
            'health_insurance' => fake()->randomElement(['Unimed', 'Hausey', 'Hospitalar', 'SUS', 'Sulamerica', 'Cassi', 'None']),
            'patient_age' => fake()->dateTimeThisCentury(),
            'exam_date' => fake()->dateTimeThisDecade(),
            'report_issuance_date' => fake()->dateTime
        ];
    }
}
