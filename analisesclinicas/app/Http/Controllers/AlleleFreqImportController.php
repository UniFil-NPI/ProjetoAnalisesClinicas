<?php

namespace App\Http\Controllers;

use App\Imports\AlleleFreqImport;
use Maatwebsite\Excel\Facades\Excel;

class AlleleFreqImportController extends Controller
{
    public function __invoke()
    {
        Excel::import(new AlleleFreqImport(), "alleleFreq.csv");
    }
}
