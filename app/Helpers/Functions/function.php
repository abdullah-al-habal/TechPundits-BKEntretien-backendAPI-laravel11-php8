<?php

declare(strict_types=1);

use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Translate a key using the current locale.
 *
 * @param  string  $key  The translation key
 * @return string The translated string
 */
function myTrans(string $key): string
{
    $local = app()->getLocale();

    return __("{$local}.{$key}");
}

/**
 * Check if the current locale is RTL.
 *
 * @return string 'rtl' if the locale is Arabic, 'ltr' otherwise
 */
function isRTL(): string
{
    $local = app()->getLocale();

    return $local === 'ar' ? 'rtl' : 'ltr';
}

/**
 * Format a date string.
 *
 * @param  string  $date  The date string to format
 * @return string The formatted date string
 */
function dateFormat(string $date): string
{
    return Carbon::parse($date)->toFormattedDateString();
}

/**
 * Check if the current request is to the panel.
 *
 * @return bool True if the request is not to the panel, false otherwise
 */
function requestToPanel(): bool
{
    return request()->route()?->getPrefix() !== '/panel';
}

if (! function_exists('currentRouteName')) {
    /**
     * Get the current route name.
     *
     * @return string The current route name or an empty string if not found
     */
    function currentRouteName(): string
    {
        $route = Request::route();

        return is_object($route) ? $route->getName() ?? '' : '';
    }
}


if (! function_exists('isLocalhost')) {
    /**
     * Check if the current host is localhost.
     *
     * @return bool True if the host is localhost, false otherwise
     */
    function isLocalhost(): bool
    {
        return 'localhost' === (parse_url(URL::full())['host'] ?? '');
    }
}

if (! function_exists('notFoundView')) {
    /**
     * Return a 404 view with a random index.
     *
     * @return mixed The 404 view
     */
    function notFoundView(): mixed
    {
        try {
            $index = random_int(0, 1);
        } catch (Exception) {
            $index = 0; // Default value if an exception occurs
        }

        return view('errors.404', ['index' => $index]);
    }
}

if (! function_exists('unSlug')) {
    /**
     * Replace a character in a string with another.
     *
     * @param  string  $title  The string to modify
     * @param  string  $replace  The character to replace
     * @param  string  $replaceTo  The character to replace with
     * @return string The modified string
     */
    function unSlug(string $title, string $replace = '-', string $replaceTo = ' '): string
    {
        return str_replace($replace, $replaceTo, $title);
    }
}

if (! function_exists('strSlug')) {
    /**
     * Replace a character in a string with another.
     *
     * @param  string  $title  The string to modify
     * @param  string  $replace  The character to replace
     * @param  string  $replaceTo  The character to replace with
     * @return string The modified string
     */
    function strSlug(string $title, string $replace = ' ', string $replaceTo = '-'): string
    {
        return str_replace($replace, $replaceTo, $title);
    }
}

if (! function_exists('isCurrentRouteName')) {
    /**
     * Check if the current route name matches the given name.
     *
     * @param  string  $name  The route name to check
     * @param  string  $returnProp  The property to return if the route matches
     * @return string The returnProp if the route matches, an empty string otherwise
     */
    function isCurrentRouteName(string $name, string $returnProp = 'active'): string
    {
        return currentRouteName() === $name ? $returnProp : '';
    }
}

if (! function_exists('storageAsset')) {
    /**
     * Get the full path for a storage asset.
     *
     * @param  string  $path  The relative path of the asset
     * @return string The full storage path
     */
    function storageAsset(string $path): string
    {
        return storage_path($path);
    }
}

if (! function_exists('saveFile')) {
    /**
     * Save a file to storage.
     *
     * @param  mixed  $file  The file to save
     * @param  string  $name  The name of the file input
     * @param  string  $path  The path to save the file to
     * @param  array  $unlink  An array containing information about a file to unlink
     * @param  null|string  $type  The type of the file (unused in this function)
     * @param  bool  $check  Whether to check if the file exists
     * @return null|string The path of the saved file, or null if an error occurred
     */
    function saveFile($file, string $name, string $path, array $unlink = [], ?string $type = null, bool $check = true): ?string
    {
        try {
            if ($unlink !== []) {
                $oldPath = substr((string) ($unlink['model']['field'] ?? ''), 1);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            if ($check) {
                checkIfFileExists($file, $name);
            }
            $pathFixing = str_replace('\\', '/', $path);
            $fileName = time() . Str::random(15) . '.' . $file->getClientOriginalExtension();
            $pathToSave = storage_path('app/public/' . $pathFixing);
            $file->move($pathToSave, $fileName);
            session()->flash('success', 'save new file success');

            return $pathFixing . $fileName;
        } catch (Exception $e) {
            // Return null if an error occurs
            return null;
        }
    }
}

if (! function_exists('checkIfFileExists')) {
    /**
     * Check if a file exists in the request.
     *
     * @param  mixed  $file  The file to check
     * @param  string  $name  The name of the file input
     *
     * @throws Exception If the file is not found or is invalid
     */
    function checkIfFileExists($file, string $name): void
    {
        if (isset(request()->all()[$name]) && gettype(request()->all()[$name]) !== 'array' && (! isset($file) || ! request()->hasFile($name))) {
            // throw new PublicException('please make sure you store correct file');
        }
    }
}

if (! function_exists('requestForApi')) {
    /**
     * Check if the current request is for the API.
     *
     * @return bool True if the request is for the API, false otherwise
     */
    function requestForApi(): bool
    {
        try {
            $url = Route::current();

            return $url !== null && $url->getPrefix() === 'api';
        } catch (Exception $e) {
            return false; // Return false if an exception occurs
        }
    }
}

if (! function_exists('formatErrorMessage')) {
    /**
     * Format an error message.
     *
     * @param  null|string  $class  The class where the error occurred
     * @param  null|int  $line  The line where the error occurred
     * @param  string  $message  The error message
     * @return string The formatted error message
     */
    function formatErrorMessage(?string $class, ?int $line, string $message): string
    {
        return 'Oops there is something went wrong in file ' . ($class ?? 'Unknown') . ' in Line ' . ($line ?? 'Unknown') . ' Details : ' . $message;
    }
}

if (! function_exists('throwExceptionResponse')) {
    /**
     * Throw an exception response.
     *
     * @param  null|string  $class  The class where the error occurred
     * @param  null|int  $line  The line where the error occurred
     * @param  string  $message  The error message
     * @param  bool  $useMessage  Whether to use the message directly or format it
     *
     * @throws Exception
     */
    function throwExceptionResponse(?string $class = null, ?int $line = null, string $message = '', bool $useMessage = true): void
    {
        $fullExceptionMessage = $useMessage
            ? $message
            : formatErrorMessage($class, $line, $message);
        if (requestForApi()) {
            // throw new PublicException($fullExceptionMessage);
        } else {
            throw new Exception($fullExceptionMessage);
        }
    }
}

if (! function_exists('throwValidationException')) {
    /**
     * Throw a validation exception.
     *
     * @param  array  $errors  The validation errors
     * @return RedirectResponse A redirect response with errors
     */
    function throwValidationException(array $errors): RedirectResponse
    {
        try {
            if (requestForApi()) {
                throwExceptionResponse(null, null, collect($errors)->collapse()->toJson()); // Convert to JSON or string
            }
        } catch (Exception) {
        }

        return redirect()->back()->withErrors($errors);
    }
}

if (! function_exists('generateRandomCode')) {
    /**
     * Generate a random code.
     *
     * @param  int  $length  The length of the code to generate
     * @return string The generated random code
     */
    function generateRandomCode(int $length): string
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');

        return substr($random, 0, $length);
    }
}

if (! function_exists('saveImage')) {
    /**
     * Save an image file.
     *
     * @param  null|mixed  $model  The model associated with the image
     * @param  null|object  $request  The request object containing the image
     * @param  null|string  $imageRequestName  The name of the image input in the request
     * @return null|string The path of the saved image, or null if an error occurred
     */
    function saveImage(mixed $model = null, ?object $request = null, ?string $imageRequestName = null): ?string
    {
        try {
            return saveFile(
                $request?->all()[$imageRequestName] ?? $request[$imageRequestName] ?? null,
                $imageRequestName ?? '',
                $model->imagePath ?? '',
                $model['id'] !== null
                    ? ['model' => $model, 'field' => $imageRequestName]
                    : []
            );
        } catch (Exception) {
        }

        return null;
    }
}

if (! function_exists('deleteImage')) {
    /**
     * Delete an image file.
     *
     * @param  null|string  $path  The path of the image to delete
     */
    function deleteImage(?string $path = null): void
    {
        if ($path !== null && file_exists($path)) {
            unlink($path);
        }
    }
}

if (! function_exists('isUpdatedRequest')) {
    /**
     * Check if the current request is an update request.
     *
     * @return bool True if the request is PUT or PATCH, false otherwise
     */
    function isUpdatedRequest(): bool
    {
        return request()->isMethod('PUT') || request()->isMethod('PATCH');
    }
}
