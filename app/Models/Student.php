<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'school_class_id',
        'department',
        'admission_number',
        'first_name',
        'last_name',
        'other_names',
        'class_name',
        'date_of_birth',
        'gender',
        'guardian_name',
        'guardian_phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function resultPins(): HasMany
    {
        return $this->hasMany(ResultPin::class);
    }

    public function resultPinPayments(): HasMany
    {
        return $this->hasMany(ResultPinPayment::class);
    }
}
