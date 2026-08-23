<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'father',
        'mother',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function childActivities(): HasMany
    {
        return $this->hasMany(ChildActivity::class)
            ->orderBy('activity_no');
    }

    public function evaluationSessions(): HasMany
    {
        return $this->hasMany(EvaluationSession::class);
    }

    public function treatmentCertificates(): HasMany
{
    return $this->hasMany(TreatmentCertificate::class);
}
}
