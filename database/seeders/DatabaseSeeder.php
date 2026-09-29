<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\cruds\AmbulanceSeeder;
use Database\Seeders\cruds\AppointmentSeeder;
use Database\Seeders\cruds\DiagnosticSeeder;
use Database\Seeders\cruds\ImageSeeder;
use Database\Seeders\cruds\InsuranceSeeder;
use Database\Seeders\cruds\InvoiceSeeder;
use Database\Seeders\cruds\LabSeeder;
use Database\Seeders\cruds\MultiServiceSeeder;
use Database\Seeders\cruds\PaymentSeeder;
use Database\Seeders\cruds\RaySeeder;
use Database\Seeders\cruds\ReceiptSeeder;
use Database\Seeders\cruds\SingleServiceSeeder;
use Database\Seeders\cruds\DepartmentSeeder;
use Database\Seeders\users\AdminSeeder;
use Database\Seeders\users\AmbulanceDriverSeeder;
use Database\Seeders\users\DoctorSeeder;
use Database\Seeders\users\LabEmployeeSeeder;
use Database\Seeders\users\PatientSeeder;
use Database\Seeders\users\RayEmployeeSeeder;
use Database\Seeders\web\FaqSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DepartmentSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            LabEmployeeSeeder::class,
            RayEmployeeSeeder::class,
            SingleServiceSeeder::class,
            MultiServiceSeeder::class,
            InvoiceSeeder::class,
            ReceiptSeeder::class,
            PaymentSeeder::class,
            AppointmentSeeder::class,
            DiagnosticSeeder::class,
            InsuranceSeeder::class,
            AmbulanceSeeder::class,
            AmbulanceDriverSeeder::class,
            LabSeeder::class,
            RaySeeder::class,
            ImageSeeder::class,
            FaqSeeder::class,
            HmsInitialDataSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
