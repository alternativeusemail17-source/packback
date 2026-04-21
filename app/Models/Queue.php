<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'from_location_id',
        'to_location_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fromLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function toLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }

    public function dresses(): BelongsToMany
    {
        return $this->belongsToMany(Dress::class, 'queue_dress')
            ->withTimestamps()
            ->orderByPivot('created_at', 'desc');
    }
}
