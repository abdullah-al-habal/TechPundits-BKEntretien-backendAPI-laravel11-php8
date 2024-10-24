<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUsSection extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function contactUs(): BelongsTo
    {
        return $this->belongsTo(related: ContactUs::class);
    }
}
