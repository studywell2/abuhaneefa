<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExaminationResult extends Model
{
    protected $fillable = [
        'examination_attempt_id',
        'ca_marks',
        'objective_marks',
        'theory_marks',
        'marks_obtained',
        'total_marks',
        'percentage',
        'outcome',
        'status',
        'reviewed_by',
        'approved_by',
        'reviewed_at',
        'approved_at',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'ca_marks' => 'integer',
            'objective_marks' => 'integer',
            'theory_marks' => 'integer',
            'marks_obtained' => 'integer',
            'total_marks' => 'integer',
            'percentage' => 'decimal:2',
            'reviewed_at' => 'datetime',
            'approved_at' => 'datetime',
        ];
    }

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(
            ExaminationAttempt::class,
            'examination_attempt_id'
        );
    }

    public function examiner(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    public function scoreAudits(): HasMany
    {
        return $this->hasMany(
            ExaminationScoreAudit::class,
            'examination_result_id'
        )->latest('entered_at');
    }
}
