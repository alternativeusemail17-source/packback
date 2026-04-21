<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function dresses(): HasMany
    {
        return $this->hasMany(Dress::class);
    }

    public function sourceQueues(): HasMany
    {
        return $this->hasMany(Queue::class, 'from_location_id');
    }

    public function destinationQueues(): HasMany
    {
        return $this->hasMany(Queue::class, 'to_location_id');
    }
}
