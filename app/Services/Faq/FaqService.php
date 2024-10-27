<?php

declare(strict_types=1);

namespace App\Services\Faq;

use App\Contracts\FaqServiceInterface;
use App\Exceptions\API\V1\Faq\FaqNotFoundException;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqService implements FaqServiceInterface
{
    public function getFaqs(): Collection
    {
        $faqs = Faq::all();

        if ($faqs->isEmpty()) {
            throw new FaqNotFoundException();
        }

        return $faqs;
    }
}
