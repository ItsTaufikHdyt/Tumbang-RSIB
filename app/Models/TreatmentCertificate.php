<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreatmentCertificate extends Model
{
    protected $fillable = [
        'child_id',
        'letter_number',
        'letter_date',
        'diagnosis',
        'statement',
        'created_by',
        'signer_name',
        'signer_title',
    ];

    protected function casts(): array
    {
        return [
            'letter_date' => 'date',
        ];
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
