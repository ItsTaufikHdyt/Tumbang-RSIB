<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChildActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'activity_no',
        'activity_name',
    ];

    protected function casts(): array
    {
        return [
            'activity_no' => 'integer',
        ];
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function evaluationDetails(): HasMany
    {
        return $this->hasMany(
            EvaluationDetail::class,
            'activity_id'
        );
    }
}
