<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testimonial extends Model
{
    public function sections(): HasMany
    {
        return $this->hasMany(related: TestimonialSection::class);
    }
}
