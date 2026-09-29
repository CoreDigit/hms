<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Cruds\Ward;
use App\Models\Cruds\Bed;
use App\Models\Cruds\MedicineCategory;
use App\Models\Cruds\Medicine;
use App\Models\Cruds\ExpenseCategory;
use App\Models\Users\Receptionist;
use App\Models\Users\Nurse;
use App\Models\Users\Accountant;
use App\Models\Users\Pharmacist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HmsInitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roles = [
            'admin' => 'Super Admin / Admin',
            'receptionist' => 'Receptionist / Front Desk',
            'doctor' => 'Doctor / Consultant',
            'nurse' => 'Nurse / Clinical Staff',
            'accountant' => 'Accountant / Billing',
            'pharmacist' => 'Pharmacist',
            'labEmployee' => 'Laboratory Technician',
            'rayEmployee' => 'Radiology Technician',
            'storeStaff' => 'Store / Inventory Manager',
            'hrStaff' => 'HR / Staff Manager',
            'patient' => 'Patient',
        ];

        foreach ($roles as $name => $label) {
            Role::firstOrCreate(
                ['name' => $name],
                ['label' => $label, 'description' => $label]
            );
        }

        // 2. Permissions
        $modules = [
            'patients' => ['view', 'create', 'edit', 'delete', 'print'],
            'appointments' => ['view', 'create', 'edit', 'cancel', 'print'],
            'tokens' => ['view', 'create', 'manage', 'print'],
            'admissions' => ['view', 'create', 'edit', 'transfer', 'discharge', 'print'],
            'prescriptions' => ['view', 'create', 'edit', 'print'],
            'vitals' => ['view', 'create', 'edit'],
            'pharmacy' => ['view', 'create', 'edit', 'refund', 'manage', 'print'],
            'inventory' => ['view', 'create', 'edit', 'manage'],
            'billing' => ['view', 'create', 'edit', 'refund', 'print'],
            'expenses' => ['view', 'create', 'approve', 'print'],
            'reports' => ['view', 'export'],
            'settings' => ['manage'],
        ];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $permName = "{$module}.{$action}";
                Permission::firstOrCreate(
                    ['name' => $permName],
                    ['label' => ucfirst($action) . ' ' . ucfirst($module), 'module' => $module]
                );
            }
        }

        // 3. Default Wards & Beds
        $generalWard = Ward::firstOrCreate(
            ['name' => 'General Male Ward'],
            ['ward_type' => 'general', 'daily_charge' => 500, 'description' => 'General Ward for male patients']
        );

        $icuWard = Ward::firstOrCreate(
            ['name' => 'ICU Ward'],
            ['ward_type' => 'icu', 'daily_charge' => 2500, 'description' => 'Intensive Care Unit']
        );

        $privateWard = Ward::firstOrCreate(
            ['name' => 'Private Room Ward'],
            ['ward_type' => 'private', 'daily_charge' => 1500, 'description' => 'Deluxe Private Rooms']
        );

        foreach (['G101', 'G102', 'G103', 'G104'] as $bedNum) {
            Bed::firstOrCreate(
                ['ward_id' => $generalWard->id, 'bed_number' => $bedNum],
                ['daily_charge' => 500, 'status' => 'available']
            );
        }

        foreach (['ICU-01', 'ICU-02'] as $bedNum) {
            Bed::firstOrCreate(
                ['ward_id' => $icuWard->id, 'bed_number' => $bedNum],
                ['daily_charge' => 2500, 'status' => 'available']
            );
        }

        foreach (['P201', 'P202'] as $bedNum) {
            Bed::firstOrCreate(
                ['ward_id' => $privateWard->id, 'bed_number' => $bedNum],
                ['daily_charge' => 1500, 'status' => 'available']
            );
        }

        // 4. Medicine Categories & Medicines
        $tabletCat = MedicineCategory::firstOrCreate(
            ['name' => 'Tablets & Capsules'],
            ['description' => 'Oral tablets and capsules']
        );

        $syrupCat = MedicineCategory::firstOrCreate(
            ['name' => 'Syrups & Liquids'],
            ['description' => 'Liquid medicine bottles']
        );

        Medicine::firstOrCreate(
            ['name' => 'Paracetamol 500mg'],
            [
                'category_id' => $tabletCat->id,
                'generic_name' => 'Acetaminophen',
                'manufacturer' => 'Cipla Labs',
                'batch_number' => 'PAR-2026-01',
                'expiry_date' => now()->addYears(2)->toDateString(),
                'purchase_price' => 2.00,
                'unit_price' => 5.00,
                'stock_quantity' => 500,
                'reorder_level' => 50,
                'is_active' => true,
            ]
        );

        Medicine::firstOrCreate(
            ['name' => 'Amoxicillin 250mg Syrup'],
            [
                'category_id' => $syrupCat->id,
                'generic_name' => 'Amoxicillin Trihydrate',
                'manufacturer' => 'Sun Pharma',
                'batch_number' => 'AMX-2026-05',
                'expiry_date' => now()->addYear()->toDateString(),
                'purchase_price' => 45.00,
                'unit_price' => 75.00,
                'stock_quantity' => 100,
                'reorder_level' => 15,
                'is_active' => true,
            ]
        );

        // 5. Expense Categories
        foreach (['Medical Supplies', 'Utilities & Electricity', 'Maintenance & Repairs', 'Salaries & Staff', 'Administrative & Printing'] as $expCat) {
            ExpenseCategory::firstOrCreate(
                ['name' => $expCat],
                ['description' => $expCat . ' category']
            );
        }

        // 6. Test Staff Accounts
        Receptionist::firstOrCreate(
            ['email' => 'reception@gmail.com'],
            ['name' => 'Hospital Receptionist', 'password' => Hash::make('password'), 'phone' => '9876543210', 'status' => true]
        );

        Nurse::firstOrCreate(
            ['email' => 'nurse@gmail.com'],
            ['name' => 'Head Nurse', 'password' => Hash::make('password'), 'phone' => '9876543211', 'status' => true]
        );

        Accountant::firstOrCreate(
            ['email' => 'accountant@gmail.com'],
            ['name' => 'Senior Accountant', 'password' => Hash::make('password'), 'phone' => '9876543212', 'status' => true]
        );

        Pharmacist::firstOrCreate(
            ['email' => 'pharmacist@gmail.com'],
            ['name' => 'Chief Pharmacist', 'password' => Hash::make('password'), 'phone' => '9876543213', 'status' => true]
        );
    }
}
