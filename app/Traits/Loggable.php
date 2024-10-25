<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait Loggable
{
    /**
     * Log an informational message.
     *
     * @param  string  $message  the message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logInfo(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * Log an error message.
     *
     * @param  string  $message  the message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logError(string $message, array $context = []): void
    {
        Log::error($message, $context);
    }

    /**
     * Log a debug message.
     *
     * @param  string  $message  the message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logDebug(string $message, array $context = []): void
    {
        Log::debug($message, $context);
    }

    /**
     * Log a warning message.
     *
     * @param  string  $message  the message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logWarning(string $message, array $context = []): void
    {
        Log::warning($message, $context);
    }

    /**
     * Log a critical message.
     *
     * @param  string  $message  the message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logCritical(string $message, array $context = []): void
    {
        Log::critical($message, $context);
    }

    /**
     * Log an exception.
     *
     * @param  Throwable  $throwable  the exception to log
     * @param  string  $message  optional custom message to log
     * @param  array<string, mixed>  $context  optional contextual information
     */
    public function logException(Throwable $throwable, string $message = '', array $context = []): void
    {
        Log::error($message ?: $throwable->getMessage(), array_merge($context, [
            'exception' => $throwable::class,
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'trace' => $throwable->getTraceAsString(),
        ]));
    }

    public function logPerformance(string $operation, float $duration, array $context = []): void
    {
        Log::info("Performance: {$operation}", array_merge($context, [
            'duration' => $duration,
        ]));
    }
}
