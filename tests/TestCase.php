<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Use SQLite in-memory database for testing
        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => ':memory:']);

        // Fake events by default
        Event::fake();

        // Fake queues by default
        Queue::fake();

        // Set up any global mocks
        $this->withoutDeprecationHandling();
    }

    protected function assertValidationError($response, string $field): void
    {
        $response->assertStatus(422)
            ->assertJsonValidationErrors([$field]);
    }

    protected function assertSuccessfulResponse($response): void
    {
        $response->assertStatus(200)
            ->assertHeader('content-type', 'application/json');
    }
}
