<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrainCleaningSection extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function drainCleaning(): BelongsTo
    {
        return $this->belongsTo(related: DrainCleaning::class);
    }
}
