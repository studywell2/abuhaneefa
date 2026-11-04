<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultPinPayment extends Model
{
    protected $fillable = [
        'student_id',
        'result_pin_id',
        'amount_paid',
        'currency',
        'payment_method',
        'payment_reference',
        'recorded_by',
        'paid_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount_paid' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function resultPin(): BelongsTo
    {
        return $this->belongsTo(ResultPin::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
