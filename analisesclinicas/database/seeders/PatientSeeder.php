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
            'user_id' => 2,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->dateTimeThisCentury($max = 'now', $timezone = null),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Masculino',
        ]);
        Patient::create([
            'user_id' => 3,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->dateTimeThisCentury($max = 'now', $timezone = null),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Feminino',
        ]);
        Patient::create([
            'user_id' => 4,
            'phone_number' => '(43)9999-7777',
            'post_code' => '86010-450',
            'street' => 'Pará',
            'building_number' => '1111',
            'secondary_address' => 'apt 202 bloco 3',
            'neighborhood' => 'Centro',
            'city' => 'Londrina',
            'state' => 'PR',
            'birth_date' => fake()->dateTimeThisCentury($max = 'now', $timezone = null),
            'health_insurance' => fake()->randomElement(['Nenhum', 'Unimed', 'Hausey', 'SUS', 'Hospitalar', 'Cassi', 'Sulamérica']),
            'biological_sex' => 'Masculino',
        ]);
    }
}
