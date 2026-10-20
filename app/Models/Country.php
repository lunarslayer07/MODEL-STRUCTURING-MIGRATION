<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $primaryKey = 'country_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['country_id', 'country_name', 'region_id'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'country_id', 'country_id');
    }
}
