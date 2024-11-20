<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoGallerySectionImage extends Model
{
    protected $fillable = [
        'photo_gallery_section_id',
        'image',
        'alt_text',
        'description',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(related: PhotoGallerySection::class);
    }
}
