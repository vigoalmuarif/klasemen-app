<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Versus extends Model
{
    use HasFactory;
    protected $table = 'matches';
    protected $guarded = [];    
    public $timestamps = true;


    public function matchHome(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'home_club_id', 'id');
    }
    public function matchAway(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'away_club_id', 'id');
    }
    
}
