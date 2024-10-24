<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

function myTrans(string $key): string
{
    $local = app()->getLocale();

    return __("$local.$key");
}

function isRTL(): string
{
    $local = app()->getLocale();

    return $local == 'ar' ? 'rtl' : 'ltr';
}

function dateFormat(string $date): string
{
    return Carbon::parse($date)->toFormattedDateString();
}

function requestToPanel(): bool
{
    return request()->route()->getPrefix() != '/panel';
}

if (! function_exists('currentRouteName')) {
    function currentRouteName(): string
    {
        $route = Request::route();

        // Check if $route is an object before calling getName()
        if (is_object($route)) {
            return $route->getName();
        }

        return ''; // Return an empty string if $route is not an object
    }
}

if (! function_exists('isLocalhost')) {
    function isLocalhost(): bool
    {
        return parse_url(URL::full())['host'] === 'localhost';
    }
}

if (! function_exists('notFoundView')) {
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
    function unSlug(string $title, string $replace = '-', string $replaceTo = ' '): string
    {
        return str_replace($replace, $replaceTo, $title);
    }
}

if (! function_exists('strSlug')) {
    function strSlug(string $title, string $replace = ' ', string $replaceTo = '-'): string
    {
        return str_replace($replace, $replaceTo, $title);
    }
}

if (! function_exists('isCurrentRouteName')) {
    function isCurrentRouteName(string $name, string $returnProp = 'active'): string
    {
        return currentRouteName() === $name ? $returnProp : '';
    }
}

if (! function_exists('storageAsset')) {
    function storageAsset(string $path): string
    {
        return storage_path($path);
    }
}

if (! function_exists('saveFile')) {
    function saveFile($file, $name, $path, array $unlink = [], $type = null, bool $check = true): ?string
    {
        try {
            if ($unlink !== []) {
                $oldPath = substr((string) $unlink['model']['field'], 1);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            if ($check) {
                checkIfFileExists($file, $name);
            }
            $pathFixing = str_replace('\\', '/', $path);
            $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
            $pathToSave = storage_path('app/public/'.$pathFixing);
            $file->move($pathToSave, $fileName);
            session()->flash('success', 'save new file success');

            return $pathFixing.$fileName;
        } catch (Exception $e) {
            // Return null if an error occurs
            return null;
        }
    }
}

if (! function_exists('checkIfFileExists')) {
    function checkIfFileExists($file, $name): void
    {
        if (isset(request()->all()[$name]) && gettype(request()->all()[$name]) !== 'array' && (! isset($file) || ! request()->hasFile($name))) {
            // throw new PublicException('please make sure you store correct file');
        }
    }
}

if (! function_exists('requestForApi')) {
    function requestForApi(): bool
    {
        try {
            $url = Route::current();

            return $url != null && $url->getPrefix() == 'api';
        } catch (Exception $e) {
            return false; // Return false if an exception occurs
        }
    }
}

if (! function_exists('formatErrorMessage')) {
    function formatErrorMessage($class, $line, $message): string
    {
        return 'Oops there is something went wrong in file '.$class.' in Line '.$line.' Details : '.$message;
    }
}

if (! function_exists('throwExceptionResponse')) {
    /**
     * @throws Exception
     */
    function throwExceptionResponse($class = null, $line = null, string $message = '', bool $useMessage = true): void
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
    function throwValidationException($errors): RedirectResponse
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
    function generateRandomCode(int $length): string
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');

        return substr($random, 0, $length);
    }
}

if (! function_exists('saveImage')) {
    /**
     * @return string|null
     */
    function saveImage(mixed $model = null, ?object $request = null, $imageRequestName = null)
    {
        try {
            return saveFile(
                $request->all()[$imageRequestName]
                    ?? $request[$imageRequestName],
                $imageRequestName,
                $model->imagePath,
                $model['id'] != null
                    ? ['model' => $model, 'field' => $imageRequestName]
                    : []
            );
        } catch (Exception) {
        }

        return null;
    }
}

if (! function_exists('deleteImage')) {
    function deleteImage($path = null): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

if (! function_exists('isUpdatedRequest')) {
    function isUpdatedRequest(): bool
    {
        return request()->isMethod('PUT') || request()->isMethod('PATCH');
    }
}
