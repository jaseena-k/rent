<?php

namespace Tests\Feature;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacancyUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_unit_status_can_be_marked_vacant_after_lease_termination(): void
    {
        $unit = Unit::factory()->create(['status' => 'occupied']);

        $this->patchJson("/api/v1/units/{$unit->id}", ['status' => 'vacant'])
            ->assertOk();

        $this->assertDatabaseHas('units', ['id' => $unit->id, 'status' => 'vacant']);
    }
}
