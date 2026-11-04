<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExaminationScoreAudit extends Model
{
    protected $fillable = [
        'examination_result_id',
        'entered_by',
        'component',
        'old_marks',
        'new_marks',
        'entered_at',
    ];

    protected function casts(): array
    {
        return [
            'old_marks' => 'integer',
            'new_marks' => 'integer',
            'entered_at' => 'datetime',
        ];
    }

    public function result(): BelongsTo
    {
        return $this->belongsTo(
            ExaminationResult::class,
            'examination_result_id'
        );
    }

    public function examiner(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'entered_by'
        );
    }
}
