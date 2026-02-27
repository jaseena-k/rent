<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $building = Building::create([
            'name' => 'Palm Residency',
            'address' => '123 Main Street, Downtown',
            'floors' => 6,
            'total_units' => 24,
            'notes' => 'Mixed studio and 1BHK units',
        ]);

        $unitA = Unit::create([
            'building_id' => $building->id,
            'unit_number' => 'A-101',
            'floor' => 1,
            'type' => '1BHK',
            'rent_amount' => 15000,
            'status' => 'occupied',
        ]);

        $unitB = Unit::create([
            'building_id' => $building->id,
            'unit_number' => 'A-102',
            'floor' => 1,
            'type' => 'Studio',
            'rent_amount' => 11000,
            'status' => 'vacant',
        ]);

        $tenant = Tenant::create([
            'name' => 'Rahul Sharma',
            'phone' => '+91-900000001',
            'email' => 'rahul@example.com',
            'id_proof' => 'passport',
            'emergency_contact' => 'Amit Sharma +91-900000002',
            'documents' => ['lease_scan.pdf', 'id_scan.pdf'],
        ]);

        $lease = Lease::create([
            'tenant_id' => $tenant->id,
            'unit_id' => $unitA->id,
            'start_date' => now()->subMonths(2),
            'end_date' => now()->addMonths(10),
            'deposit' => 30000,
            'monthly_rent' => 15000,
            'due_day' => 5,
            'status' => 'active',
        ]);

        Invoice::create([
            'lease_id' => $lease->id,
            'billing_month' => now()->startOfMonth(),
            'amount' => 15000,
            'balance' => 15000,
            'status' => 'unpaid',
            'due_date' => now()->startOfMonth()->addDays(4),
        ]);

        Expense::create([
            'building_id' => $building->id,
            'category' => 'maintenance',
            'amount' => 5000,
            'expense_date' => now()->subDays(7),
            'description' => 'Elevator preventive maintenance',
        ]);

        // Prevent unused variable warnings in static analyzers.
        unset($unitB);
    }
}
