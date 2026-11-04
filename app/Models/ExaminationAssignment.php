<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExaminationAssignment extends Model
{
    protected $fillable = [
        'examination_id',
        'examiner_id',
        'assigned_by',
        'assigned_at',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
        ];
    }

    public function examination(): BelongsTo
    {
        return $this->belongsTo(Examination::class);
    }

    public function examiner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'examiner_id');
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}