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
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('visit_date')->comment('تاریخ ویزیت');
            $table->date('follow_up_date')->nullable()->comment('تاریخ مراجعه بعدی');
            $table->string("visit_reason")->nullable()->comment("دلیل مراجعه");
            $table->string("symptoms")->nullable()->comment("علائم");
            $table->text('diagnosis')->nullable()->comment('تشخیص پزشک');
            $table->string("handwritten_notes")->nullable()->comment("دست نویس");
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
