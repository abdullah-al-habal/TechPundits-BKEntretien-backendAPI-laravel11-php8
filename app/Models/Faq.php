<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    protected $fillable = [
        'home_page_id',
        'image',
        'question',
        'answer',
    ];

    public function homePage(): BelongsTo
    {
        return $this->belongsTo(related: HomePage::class);
    }
}
