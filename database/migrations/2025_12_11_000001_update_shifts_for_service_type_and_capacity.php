<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            // Service type for this shift (doctor visit vs injection/serum therapy)
            $table->string('service_type')->default('doctor')->after('doctor_id');
            // Optional specific date for the shift (date-based shift)
            $table->date('date')->nullable()->after('day');
            // Recurrence support: is this a recurring weekly shift (using day column)
            $table->boolean('is_recurring')->default(false)->after('date');
            // End date for recurrence window (inclusive). Null = no end (infinite)
            $table->date('repeat_until')->nullable()->after('is_recurring');
            // Capacity per slot (default 1 for doctor visit; can be >1 for injection/serum therapy)
            $table->unsignedInteger('capacity_per_slot')->default(1)->after('duration');
        });
    }

    public function down(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn(['service_type', 'date', 'is_recurring', 'repeat_until', 'capacity_per_slot']);
        });
    }
};
