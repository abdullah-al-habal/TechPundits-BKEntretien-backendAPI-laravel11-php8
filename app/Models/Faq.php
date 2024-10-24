<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    protected $fillable = [
        'image',
        'question',
        'answer'
    ];

    public function homePage(): BelongsTo
    {
        return $this->belongsTo(related: HomePage::class);
    }
}
