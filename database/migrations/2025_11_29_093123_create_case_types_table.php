<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ایجاد جدول case_types
        Schema::create('case_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // اضافه کردن foreign key به جدول CaseMedical
        Schema::table('case_medicals', function (Blueprint $table) {
            $table->foreignId('case_type_id')
                ->after('patient_id')
                ->constrained('case_types');
            $table->dropColumn('case_type'); // حذف ستون قدیمی
        });
    }

    public function down(): void
    {
        Schema::table('case_medicals', function (Blueprint $table) {
            $table->string('case_type')->after('patient_id');
            $table->dropForeign(['case_type_id']);
            $table->dropColumn('case_type_id');
        });

        Schema::dropIfExists('case_types');
    }
};
