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
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->enum('case', ['credit', 'debit']);
            $table->enum('transaction_type', ['payment', 'receipt', 'invoice']);
            $table->foreignId('transaction_id');
            $table->timestamps();
        });
        // Note: It stored with each (invoice, payment, receipt)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_accounts');
    }
};
