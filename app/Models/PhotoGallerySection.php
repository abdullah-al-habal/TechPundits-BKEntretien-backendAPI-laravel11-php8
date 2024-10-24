<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PhotoGallerySection extends Model
{
    protected $fillable = [
        'title'
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
