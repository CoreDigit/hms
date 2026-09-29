<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Receipt;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    public function run(): void
    {
        Receipt::factory()->count(10)->create();
    }
}
