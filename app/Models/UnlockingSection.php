<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnlockingSection extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function unlocking(): BelongsTo
    {
        return $this->belongsTo(related: Unlocking::class);
    }
}
