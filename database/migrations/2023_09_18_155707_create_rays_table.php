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
        Schema::create('rays', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->longText('diagnosis')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->foreignId('diagnostic_id')->constrained()->onDelete('cascade');
            $table->foreignId('ray_employee_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Description: form doctor
     * Diagnosis: from rayEmployee
     */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rays');
    }
};
