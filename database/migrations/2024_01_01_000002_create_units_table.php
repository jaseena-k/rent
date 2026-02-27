<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->string('unit_number');
            $table->integer('floor');
            $table->string('type');
            $table->decimal('rent_amount', 12, 2);
            $table->enum('status', ['occupied', 'vacant', 'maintenance'])->default('vacant');
            $table->timestamps();

            $table->unique(['building_id', 'unit_number']);
            $table->index(['building_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
