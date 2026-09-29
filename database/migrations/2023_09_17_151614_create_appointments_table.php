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
            $table->date('date');               // Adjusted by patient
            $table->time('time')->nullable();   // Adjusted by doctor
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'in-progress', 'completed'])->default('pending');
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->unique(['doctor_id', 'patient_id']);
            $table->timestamps();
        });
    }
    /**
     * adjusted by patient
     * Invoice in appointment to:
     *      - choose service 
     *      - paying_case (paid, pending)
     *      - link between doctor and appointment throw invoice
     *      - link between patient and appointment throw invoice
     * when doctor approve the appointment,
     *      - new diagnostics created
     */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
