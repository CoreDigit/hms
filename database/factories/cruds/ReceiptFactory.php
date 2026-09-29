<?php

namespace Database\Factories\cruds;

use App\Models\Cruds\FundAccount;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiptFactory extends Factory
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
        return $this->afterCreating(function (Receipt $receipt) {
            PatientAccount::create([
                'patient_id' => $receipt->patient_id,
                'amount' => $receipt->amount,
                'case' => 'credit',
                'transaction_type' => 'receipt',
                'transaction_id' => $receipt->id,
            ]);
            FundAccount::create([
                'amount' => $receipt->amount,
                'case' => 'debit',
                'transaction_type' => 'receipt',
                'transaction_id' => $receipt->id,
            ]);
        });
    }
}
