<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentPaymentFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_partial_and_full_payment_updates_invoice_balance_and_status(): void
    {
        $tenant = Tenant::factory()->create();
        $unit = Unit::factory()->create();
        $lease = Lease::factory()->create(['tenant_id' => $tenant->id, 'unit_id' => $unit->id]);
        $invoice = Invoice::factory()->create([
            'lease_id' => $lease->id,
            'amount' => 1000,
            'balance' => 1000,
            'status' => 'unpaid',
        ]);

        $this->postJson("/api/v1/invoices/{$invoice->id}/payments", [
            'amount' => 400,
            'payment_date' => now()->toDateString(),
            'method' => 'cash',
            'receipt_number' => 'R-001',
        ])->assertCreated();

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id, 'balance' => 600, 'status' => 'partial']);

        $this->postJson("/api/v1/invoices/{$invoice->id}/payments", [
            'amount' => 600,
            'payment_date' => now()->toDateString(),
            'method' => 'cash',
            'receipt_number' => 'R-002',
        ])->assertCreated();

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id, 'balance' => 0, 'status' => 'paid']);
    }
}
