<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomePage extends Model
{
    protected $table = 'home_pages';

    protected $fillable = [
        'banner_image',
        'banner_image_alt_text',
        'banner_image_text',
        'main_image',
        'main_image_alt_text',
        'main_image_text',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(related: HomePageSection::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(related: Faq::class);
    }
}
