<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Standings extends Model
{
    use HasFactory;
    protected $table = 'standings';
    protected $guarded = [];
    public $timestamps = true;


 /**
     * Get the user that owns the Standings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }
}
