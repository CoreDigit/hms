<?php

namespace Database\Factories\cruds;

use App\Models\Cruds\FundAccount;
use App\Models\Cruds\Invoice;
use App\Models\Cruds\PatientAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'case' => $this->faker->randomElement(['paid', 'pending']),
            'service_id' => rand(1, 19),
            'patient_id' => rand(1, 8),
            'doctor_id' => rand(1, 5),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Invoice $invoice) {
            PatientAccount::create([
                'patient_id' => $invoice->patient_id,
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'credit' : 'debit',
                'transaction_type' => 'invoice',
                'transaction_id' => $invoice->id,
            ]);
            FundAccount::create([
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'debit' : 'credit',
                'transaction_type' => 'invoice',
                'transaction_id' => $invoice->id,
            ]);
        });
    }
}
