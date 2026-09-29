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
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->decimal('amount');
            $table->enum('case', ['credit', 'debit']);
            $table->enum('transaction_type', ['payment', 'receipt', 'invoice']);
            $table->foreignId('transaction_id');
            $table->timestamps();
        });
        // Note: It stored with each transaction (payment, receipt, invoice)
        // Note: the patient is main with one of the (invoice, receipt, payment)
        // payment -> debit
        // receipt -> credit
        // invoice based on paymend case:
        // paid -> credit
        // pending -> debit
        // because I had missed and thought that saving space and making froeingId null is bad, ...
        // I had to add manually function in each ['payment', 'receipt', 'invoice'] models to ...
        // delete them from patient account
        // not just that, and manually delete in each model that depend on invoice like doctor, ...
        // patient, service models to delete their patient account
        // SO DON'T SAVE SPACE AND DUPLICATE FOR FAST, CLEAR CODE.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
