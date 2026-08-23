<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationDetail extends Model
{
    use HasFactory;

    public const SCORE_FULL_PROMPTED = 0;

    public const SCORE_70_PERCENT_PROMPTED = 3;

    public const SCORE_30_PERCENT_PROMPTED = 7;

    public const SCORE_INDEPENDENT = 10;

    public const SCORE_OPTIONS = [
        self::SCORE_FULL_PROMPTED,
        self::SCORE_70_PERCENT_PROMPTED,
        self::SCORE_30_PERCENT_PROMPTED,
        self::SCORE_INDEPENDENT,
    ];

    protected $fillable = [
        'session_id',
        'activity_id',
        'score',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
        ];
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(
            EvaluationSession::class,
            'session_id'
        );
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(
            ChildActivity::class,
            'activity_id'
        );
    }
}
