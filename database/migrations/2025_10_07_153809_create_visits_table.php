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
            $table->foreignId('case_medical_id')->constrained('case_medicals')->onDelete('cascade')->comment('ارتباط با جدول case_medicals');
            $table->date('follow_up_date')->nullable()->comment('تاریخ مراجعه بعدی');
            $table->string("visit_reason")->nullable()->comment("دلیل مراجعه");
            $table->string("symptoms")->nullable()->comment("علائم");
            $table->text('diagnosis')->nullable()->comment('تشخیص پزشک');
            $table->text('notes')->nullable()->comment('توضیحات ویزیت');
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
