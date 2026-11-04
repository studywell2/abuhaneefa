<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResultPin extends Model
{
    protected $fillable = [
        'student_id',
        'pin_hash',
        'start_academic_year',
        'start_term',
        'end_academic_year',
        'end_term',
        'issued_by',
        'issued_at',
        'status',
        'revoked_by',
        'revoked_at',
        'revocation_reason',
    ];

    protected $hidden = [
        'pin_hash',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
            'revoked_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function revoker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'revoked_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(ResultPinPayment::class);
    }
}
