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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('date')->comment('تاریخ نوبت');
            $table->time('start_time')->comment('ساعت شروع نوبت');
            $table->boolean('attended')->default(false)->comment('آیا بیمار حضور پیدا کرده یا نه');

            $table->unsignedTinyInteger('payment_method')->default(1)->comment('روش پرداخت');
            $table->string('transaction_id')->nullable()->comment('شناسه تراکنش');
            $table->longText('payment_info')->nullable()->comment('اطلاعات پرداخت');
            $table->string('customer_ip', 15)->nullable()->comment('IP مشتری');
            $table->string('customer_user_agent', 1000)->nullable()->comment('مشخصات دستگاه مشتری');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
