<?php

declare(strict_types=1);

namespace App\Helpers;

class StringHelper
{
    /**
     * Convert a string to a slug.
     */
    public static function slugify(string $text): string
    {
        // Convert the string to lowercase
        $text = strtolower($text);

        // Replace non-letter or non-digits with -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // Trim the string
        $text = trim((string) $text, '-');

        // Remove unwanted characters
        return preg_replace('~[^-\w]+~', '', $text);
    }
}
