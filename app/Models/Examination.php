<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Examination extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'school_class_id',
        'department',
        'academic_year',
        'term',
        'duration_minutes',
        'total_marks',
        'ca_total',
        'objective_total',
        'theory_total',
        'pass_mark',
        'mode',
        'start_time',
        'end_time',
        'instructions',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'duration_minutes' => 'integer',
            'total_marks' => 'integer',
            'ca_total' => 'integer',
            'objective_total' => 'integer',
            'theory_total' => 'integer',
            'pass_mark' => 'integer',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ExaminationQuestion::class)
            ->orderBy('question_order');
    }

    public function examinerAssignments(): HasMany
    {
        return $this->hasMany(ExaminationAssignment::class);
    }

    public function examiners(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'examination_assignments',
            'examination_id',
            'examiner_id'
        )
            ->withPivot(['assigned_by', 'assigned_at'])
            ->withTimestamps();
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ExaminationAttempt::class);
    }
}
