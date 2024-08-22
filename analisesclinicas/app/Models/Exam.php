<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_name',
        'lab',
        'health_insurance',
        'exam_date',
        'description'
    ];

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
