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
        Schema::create('case_medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('title')->comment("عنوان ریز پرونده");
            $table->date('case_date')->comment('تاریخ ریز پرونده');
            $table->string('case_medical_type_id')->comment('نوع ریز پرونده');
            $table->text('notes')->nullable()->comment('یادداشت زیر پرونده');
            $table->boolean('pin')->default(false)->comment('پین');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
