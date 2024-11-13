<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaternityTest extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     protected $fillable = [
        'patient_id',
        'type',
        'participants',
        'lab',
        'health_insurance',
        'exam_date',
        'description',
        'pdf',
        'state',
    ];

    protected function casts(): array
    {
        return [
            'exam_date' => 'datetime:d-m-Y',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

}
