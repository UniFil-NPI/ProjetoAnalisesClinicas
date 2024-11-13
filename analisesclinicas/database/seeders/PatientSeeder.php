<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Patient::create([
            'user_id' => 7,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Masculino',
        ]);
        Patient::create([
            'user_id' => 8,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Feminino',
        ]);
        Patient::create([
            'user_id' => 9,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Masculino',
        ]);
    }
}
