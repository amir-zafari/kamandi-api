<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            $table->date('visit_date')->nullable()->comment('تاریخ ویزیت');
            $table->text('notes')->nullable()->comment('توضیحات ویزیت');
            $table->text('diagnosis')->nullable()->comment('تشخیص پزشک');
            $table->date('follow_up_date')->nullable()->comment('تاریخ مراجعه بعدی');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
