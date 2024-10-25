<?php

declare(strict_types=1);

namespace App\Services\SiteSetting;

use App\Exceptions\API\V1\SiteSetting\SiteSettingNotFoundException;
use App\Models\SiteSetting;
use Illuminate\Pagination\LengthAwarePaginator;

class SiteSettingService
{
    /**
     * @param  int  $perPage  Number of items per page
     *
     * @throws SiteSettingNotFoundException
     */
    public function getAllSettings(int $perPage = 15): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $settings */
        $settings = SiteSetting::paginate(perPage: $perPage);

        if ($settings->isEmpty()) {
            throw new SiteSettingNotFoundException();
        }

        return $settings;
    }
}
