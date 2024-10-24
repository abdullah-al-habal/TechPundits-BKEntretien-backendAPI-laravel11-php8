<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomePageSection extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    public function homePage(): BelongsTo
    {
        return $this->belongsTo(related: HomePage::class);
    }
}
