<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'evaluator_id',
        'evaluation_date',
        'total_score',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'evaluation_date' => 'date',
            'total_score' => 'integer',
        ];
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'evaluator_id'
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(
            EvaluationDetail::class,
            'session_id'
        );
    }
}
