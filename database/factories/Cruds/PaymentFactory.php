<?php

namespace Database\Factories\cruds;

use App\Models\Cruds\FundAccount;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'notes' => $this->faker->sentence,
            'patient_id' => rand(1, 8),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Payment $payment) {
            PatientAccount::create([
                'patient_id' => $payment->patient_id,
                'amount' => $payment->amount,
                'case' => 'debit',
                'transaction_type' => 'payment',
                'transaction_id' => $payment->id,
            ]);
            FundAccount::create([
                'amount' => $payment->amount,
                'case' => 'credit',
                'transaction_type' => 'payment',
                'transaction_id' => $payment->id,
            ]);
        });
    }
}
