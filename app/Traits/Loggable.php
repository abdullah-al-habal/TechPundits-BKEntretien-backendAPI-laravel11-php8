<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Loggable
{
    /**
     * Log an informational message.
     *
     * @param  string  $message  The message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logInfo(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * Log an error message.
     *
     * @param  string  $message  The message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logError(string $message, array $context = []): void
    {
        Log::error($message, $context);
    }

    /**
     * Log a debug message.
     *
     * @param  string  $message  The message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logDebug(string $message, array $context = []): void
    {
        Log::debug($message, $context);
    }

    /**
     * Log a warning message.
     *
     * @param  string  $message  The message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logWarning(string $message, array $context = []): void
    {
        Log::warning($message, $context);
    }

    /**
     * Log a critical message.
     *
     * @param  string  $message  The message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logCritical(string $message, array $context = []): void
    {
        Log::critical($message, $context);
    }

    /**
     * Log an exception.
     *
     * @param  \Throwable  $throwable  The exception to log.
     * @param  string  $message  Optional custom message to log.
     * @param  array<string, mixed>  $context  Optional contextual information.
     */
    public function logException(\Throwable $throwable, string $message = '', array $context = []): void
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
