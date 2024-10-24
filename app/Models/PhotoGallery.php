<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoGallery extends Model
{
    protected $fillable = [
        'banner_image',
        'banner_image_alt_text',
        'title',
        'description',
        'main_image',
        'main_image_alt_text',
        'main_image_text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(related: PhotoGallerySection::class);
    }
}
