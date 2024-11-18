<?php

namespace Database\Seeders;

use App\Models\PaternityTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaternityTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaternityTest::create([
            'patient_id' => 1,
            'participants' => json_encode(['813.070.130-82', '952.510.680-26']),
            'lab' => 'UniFil lab',
            'health_insurance' => 'Unimed',
            'exam_date' => fake()->date($format = 'Y-m-d'),
            'description' => 'Trio',
        ]);

        PaternityTest::create([
            'patient_id' => 1,
            'participants' => json_encode(['952.510.680-26']),
            'lab' => 'UniFil lab',
            'health_insurance' => 'Unimed',
            'exam_date' => fake()->date($format = 'Y-m-d'),
            'description' => 'Duo',
        ]);
    }
}
