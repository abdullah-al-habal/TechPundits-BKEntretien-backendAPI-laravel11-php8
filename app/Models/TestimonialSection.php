<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonialSection extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function testimonial(): BelongsTo
    {
        return $this->belongsTo(related: Testimonial::class);
    }
}
