<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['department_name', 'location_id'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function jobHistories(): HasMany
    {
        return $this->hasMany(JobHistory::class);
    }
}
