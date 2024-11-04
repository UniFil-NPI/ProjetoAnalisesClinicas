<?php

namespace App\Imports;

use App\Models\AlleleFreq;
use Maatwebsite\Excel\Concerns\ToModel;

class AlleleFreqImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AlleleFreq([
            'Alelo' => $row[0],
            'D3S1358' => (double) str_replace(',', '.', $row[1]),
            'VWA' => (double) str_replace(',', '.', $row[2]),
            'FGA' => (double) str_replace(',', '.', $row[3]),
            'D8S1179' => (double) str_replace(',', '.', $row[4]),
            'D21S11' =>  (double) str_replace(',', '.', $row[5]),
            'D18S51' =>  (double) str_replace(',', '.', $row[6]),
            'D5S818' =>  (double) str_replace(',', '.', $row[7]),
            'D13S317' => (double) str_replace(',', '.', $row[8]),
            'D7S820' =>  (double) str_replace(',', '.', $row[9]),
            'D16S539' => (double) str_replace(',', '.', $row[10]),
            'THO1' =>    (double) str_replace(',', '.', $row[11]),
            'TPOX' =>    (double) str_replace(',', '.', $row[12]),
            'CSF1PO' =>  (double) str_replace(',', '.', $row[13]),
            'D2S1338' => (double) str_replace(',', '.', $row[14]),
            'D19S433' => (double) str_replace(',', '.', $row[15]),
        ]);
    }
}
