<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
        'regency_id',
    ];


    public function standings(): BelongsTo
    {
        return $this->belongsTo(Standings::class);
    }

    public function versus(): HasMany
    {
        return $this->hasMany(Versus::class, 'home_club_id', 'id');
    }
}
