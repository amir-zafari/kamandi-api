<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
// ایجاد جدول case_medical_types
        Schema::create('case_medical_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

// اضافه کردن foreign key به جدول case_medicals
        Schema::table('case_medicals', function (Blueprint $table) {
            if (!Schema::hasColumn('case_medicals', 'case_medical_type_id')) {
                $table->foreignId('case_medical_type_id')
                    ->after('patient_id')
                    ->constrained('case_medical_types'); // تغییر نام جدول در constrained
            }

            if (Schema::hasColumn('case_medicals', 'case_medical_type')) {
                $table->dropColumn('case_medical_type');
            }
        });

    }

    public function down(): void
    {
        Schema::table('case_medicals', function (Blueprint $table) {
            $table->string('case_medical_type')->after('patient_id');
            $table->dropForeign(['case_medical_type_id']);
            $table->dropColumn('case_medical_type_id');
        });

        Schema::dropIfExists('case_medical_types');
    }
};
