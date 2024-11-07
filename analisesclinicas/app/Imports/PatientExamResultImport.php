<?php

namespace App\Imports;

use App\Models\PatientExamResult;
use Maatwebsite\Excel\Concerns\ToModel;

class PatientExamResultImport implements ToModel
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PatientExamResult([
            'patient_id' => $row[1],
            'requisition_id' => $row[2],
            'exam_type_name' => $row[3],
            'exam_value' => $row[4],
            'start_date' => $row[5],
            'patient_name' => $row[6],
            'patient_gender' => $row[7],
            'operator_name' => $row[8],
            'end_date' => $row[9],
        ]);
    }
}
