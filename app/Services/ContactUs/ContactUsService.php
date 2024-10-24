<?php

declare(strict_types=1);

namespace App\Services\ContactUs;

use App\Exceptions\API\V1\ContactUs\ContactUsNotFoundException;
use App\Models\ContactUs;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactUsService
{
    public function getContactInfo(int $perPage = 15): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $contactInfo */
        $contactInfo = ContactUs::with('sections')->paginate(perPage: $perPage);

        if ($contactInfo->isEmpty()) {
            throw new ContactUsNotFoundException();
        }

        return $contactInfo;
    }
}
