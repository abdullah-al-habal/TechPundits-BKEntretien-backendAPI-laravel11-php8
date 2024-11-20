<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactUs extends Model
{
    protected $table = 'contact_uses';

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
        return $this->hasMany(related: ContactUsSection::class);
    }
}
