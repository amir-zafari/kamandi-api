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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_id')->unique(); // کد ملی
            $table->enum('gender', ['male', 'female']); // جنسیت
            $table->date('birth_date')->comment("تاریخ تولد");
            $table->string('blood_type',3)->nullable()->comment("گروه خونی");
            $table->text("allergies")->nullable()->comment("حساسیت‌های دارویی و غذایی");
            $table->text("chronic_diseases")->nullable()->comment("بیماری‌های مزمن");
            $table->text("notes")->nullable()->comment("یادداشت‌");
            $table->string('emergency_contact')->nullable()->comment("شماره اضطراری");
            $table->text("address")->nullable()->comment("ادرس");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
