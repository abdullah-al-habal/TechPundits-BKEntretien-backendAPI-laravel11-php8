<?php

declare(strict_types=1);

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Ignore
{
    public function __construct(
        public array $in = ['production']
    ) {}
}
