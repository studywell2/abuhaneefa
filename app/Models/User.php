<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Student relationship
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    // Examination assignment records belonging to this examiner.
    public function examinerAssignments(): HasMany
    {
        return $this->hasMany(
            ExaminationAssignment::class,
            'examiner_id'
        );
    }

    // Examinations assigned to this examiner.
    public function assignedExaminations(): BelongsToMany
    {
        return $this->belongsToMany(
            Examination::class,
            'examination_assignments',
            'examiner_id',
            'examination_id'
        )
            ->withPivot(['assigned_by', 'assigned_at'])
            ->withTimestamps();
    }

    // Result PINs issued by this administrator.
    public function issuedResultPins(): HasMany
    {
        return $this->hasMany(ResultPin::class, 'issued_by');
    }

    // Result PINs revoked by this administrator.
    public function revokedResultPins(): HasMany
    {
        return $this->hasMany(ResultPin::class, 'revoked_by');
    }

    // Result PIN payments recorded by this administrator.
    public function recordedResultPinPayments(): HasMany
    {
        return $this->hasMany(
            ResultPinPayment::class,
            'recorded_by'
        );
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
}
