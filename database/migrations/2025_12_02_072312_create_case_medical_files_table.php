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
        Schema::create('case_medical_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_medical_id');
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->string('format')->nullable();
            $table->bigInteger('size')->nullable();
            $table->timestamps();

            $table->foreign('case_medical_id')
                ->references('id')->on('case_medicals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_medical_files');
    }
};
