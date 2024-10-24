<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoGallerySection extends Model
{
    protected $fillable = [
        'title',
    ];

    public function photoGallery(): BelongsTo
    {
        return $this->belongsTo(related: PhotoGallery::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(related: PhotoGallerySectionImage::class);
    }
}
