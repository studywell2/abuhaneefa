<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAnswer extends Model
{
    protected $fillable = [
        'examination_attempt_id',
        'examination_question_id',
        'selected_option',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(
            ExaminationAttempt::class,
            'examination_attempt_id'
        );
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            ExaminationQuestion::class,
            'examination_question_id'
        );
    }
}
