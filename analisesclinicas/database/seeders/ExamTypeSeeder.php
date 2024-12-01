<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            [
                'name' => 'CRE',
                'components_info' => json_encode([
                    [
                        'name' => 'Creatinina',
                        'min_female' => 0.5,
                        'max_female' => 1.1,
                        'min_male' => 0.7,
                        'max_male' => 1.3,
                        'metric' => 'mg/dL'
                    ]
                ]),
            ],
            [
                'name' => 'URE',
                'components_info' => json_encode([
                    [
                        'name' => 'Ureia',
                        'min_female' => 15.0,
                        'max_female' => 45.0,
                        'min_male' => 15.0,
                        'max_male' => 45.0,
                        'metric' => 'mg/dL'
                    ]
                ]),
            ],
            [
                'name' => 'GLI',
                'components_info' => json_encode([
                    [
                        'name' => 'Glicose',
                        'min_female' => 70.0,
                        'max_female' => 99.0,
                        'min_male' => 70.0,
                        'max_male' => 99.0,
                        'metric' => 'mg/dL'
                    ]
                ]),
            ],
            [
                'name' => 'URE + GLI',
                'components_info' => json_encode([
                    [
                        'name' => 'Glicose',
                        'min_female' => 70.0,
                        'max_female' => 99.0,
                        'min_male' => 70.0,
                        'max_male' => 99.0,
                        'metric' => 'mg/dL'
                    ],
                    [
                        'name' => 'Ureia',
                        'min_female' => 15.0,
                        'max_female' => 45.0,
                        'min_male' => 15.0,
                        'max_male' => 45.0,
                        'metric' => 'mg/dL'
                    ]
                ]),
            ],
        ];

        foreach ($exams as $exam) {
            ExamType::create($exam);
        }
    }
}
