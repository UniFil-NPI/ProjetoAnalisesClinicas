<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;

    protected static $usedUserIds = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getRandomUnusedUserId(),
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
     /**
     * Get a random user ID that has not been used.
     *
     * @return int
     */
    protected function getRandomUnusedUserId(): int
    {
        // Get all user IDs that are currently associated with patients
        $usedUserIds = array_merge(self::$usedUserIds, Patient::pluck('user_id')->toArray());

        $allUserIds = range(2, 4); // Ajuste conforme necessário
        $unusedUserIds = array_diff($allUserIds, $usedUserIds);

        // Continue trying until an unused user ID is found
        if (empty($unusedUserIds)) {
            throw new \Exception("Não há mais user IDs disponíveis.");
        }

        $userId = $this->faker->randomElement($unusedUserIds);
        self::$usedUserIds[] = $userId; // Track the used user_id

        return $userId;
    }
}
