<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'name' => 'medico1',
            'crm'=> '1234',
        ]);

        Doctor::create([
            'name' => 'medico2',
            'crm'=> '5678',
        ]);
    }
}
