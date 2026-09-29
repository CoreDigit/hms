<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        Invoice::factory()->count(10)->create();
    }
}
