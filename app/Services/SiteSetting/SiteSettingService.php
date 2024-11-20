<?php

declare(strict_types=1);

namespace App\Services\SiteSetting;

use App\Exceptions\API\V1\SiteSetting\SiteSettingNotFoundException;
use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SiteSettingService
{
    /**
     * @param  int  $perPage  Number of items per page
     *
     * @throws SiteSettingNotFoundException
     */
    public function getAllSettings(): Collection
    {
        $settings = SiteSetting::all(['key', 'value']);

        if ($settings->isEmpty()) {
            throw new SiteSettingNotFoundException();
        }

        return $settings;
    }
}
