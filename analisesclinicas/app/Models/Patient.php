<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $fillable = [
        'user_id',
        'phone_number',
        'post_code',
        'street',
        'building_number',
        'secondary_address',
        'neighborhood',
        'city',
        'state',
        'birth_date',
        'health_insurance',
        'biological_sex',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime:Y-m-d',
        ];
    }

    public function patientExamResult(): BelongsTo
    {
        return $this->belongsTo(PatientExamResult::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function paternityTests(): HasMany
    {
        return $this->hasMany(PaternityTest::class);
    }
}
