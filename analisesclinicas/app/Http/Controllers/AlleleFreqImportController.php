<?php

namespace App\Http\Controllers;

use App\Imports\AlleleFreqImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AlleleFreqImportController extends Controller
{
    public function __invoke()
    {
            Excel::import(new AlleleFreqImport, 'alleleFreq.csv');
    }
}
