<?php

namespace Tests\Feature;

use App\Models\Lease;
use App\Services\ReminderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaseExpiryReminderTest extends TestCase
{
    use RefreshDatabase;

    public function test_expiring_leases_are_returned_for_reminders(): void
    {
        Lease::factory()->create([
            'status' => 'active',
            'end_date' => now()->addDays(10),
        ]);

        Lease::factory()->create([
            'status' => 'active',
            'end_date' => now()->addDays(60),
        ]);

        $leases = app(ReminderService::class)->expiringLeases(30);

        $this->assertCount(1, $leases);
    }
}
