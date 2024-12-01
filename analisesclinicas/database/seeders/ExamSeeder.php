<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exam::create([
            'patient_id' => 2,
            'doctor_id' => 1,
            'exam_type_id' => 2,
            'lab' => 'UniFil Lab',
            'health_insurance' => 'Unimed',
            'exam_date' => fake()->date($format = 'Y-m-d', $min = 'now'),
            'description' => 'Ureia',
        ]);

        Exam::create([
            'patient_id' => 2,
            'doctor_id' => 2,
            'exam_type_id' => 1,
            'lab' => 'UniFil Lab',
            'health_insurance' => 'Hausey',
            'exam_date' => fake()->date($format = 'Y-m-d', $min = 'now'),
            'description' => 'Creatinina',
        ]);

        Exam::create([
            'patient_id' => 1,
            'doctor_id' => 2,
            'exam_type_id' => 4,
            'lab' => 'UniFil Lab',
            'health_insurance' => 'Hospitalar',
            'exam_date' => fake()->date($format = 'Y-m-d', $min = 'now'),
            'description' => 'Ureia + Glicose',
        ]);

    }
}
