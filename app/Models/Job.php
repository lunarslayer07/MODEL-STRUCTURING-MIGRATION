<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $fillable = ['job_title', 'min_salary', 'max_salary'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function jobHistories(): HasMany
    {
        return $this->hasMany(JobHistory::class);
    }
}
