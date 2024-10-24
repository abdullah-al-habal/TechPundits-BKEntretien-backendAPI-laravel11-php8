<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unlocking extends Model
{
    protected $table = 'unlockings';

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
        return $this->hasMany(UnlockingSection::class);
    }
}
