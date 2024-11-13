<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientExamResult extends Model
{
    protected $fillable = [
        'patient_id',
        'requisition_id',
        'exam_type_name',
        'exam_value',
        'start_date',
        'patient_name',
        'patient_gender',
        'operator_name',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:d-m-Y H:i:s',
            'end_date' => 'datetime:d-m-Y H:i:s'
        ];
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }
}
