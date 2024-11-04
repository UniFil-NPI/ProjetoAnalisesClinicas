<?php

namespace Database\Seeders;

use App\Http\Controllers\AlleleFreqImportController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlleleFreqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AlleleFreqImportController = new AlleleFreqImportController();
        $AlleleFreqImportController();
    }
}
