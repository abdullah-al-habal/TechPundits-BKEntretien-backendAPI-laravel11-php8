<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactUs extends Model
{
    protected $table = 'contact_uses';

    public function sections(): HasMany
    {
        return $this->hasMany(related: ContactUsSection::class);
    }
}
