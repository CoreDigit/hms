<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::factory()->count(10)->create();
    }
}
