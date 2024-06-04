<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'doctor_name',
        'lab',
        'health_insurance',
        'patient_age',
        'exam_date',
        'report_issuance_date'

    ];

    public function patient() : HasOne
    {
        return $this->hasOne(Patient::class);
    }
}
