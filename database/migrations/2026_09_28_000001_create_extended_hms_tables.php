<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Extended fields for patients
        Schema::table('patients', function (Blueprint $table) {
            if (!Schema::hasColumn('patients', 'uhid')) {
                $table->string('uhid')->nullable()->unique()->after('id');
                $table->string('photo')->nullable();
                $table->integer('age')->nullable();
                $table->string('alt_phone')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->string('emergency_contact_name')->nullable();
                $table->string('emergency_contact_phone')->nullable();
                $table->string('emergency_contact_relation')->nullable();
                $table->string('marital_status')->nullable();
                $table->string('occupation')->nullable();
                $table->string('id_proof_type')->nullable();
                $table->string('id_proof_number')->nullable();
                $table->string('referral_source')->nullable();
                $table->text('allergies')->nullable();
                $table->text('existing_conditions')->nullable();
                $table->boolean('is_emergency')->default(false);
                $table->boolean('is_vip')->default(false);
                $table->boolean('is_archived')->default(false);
                $table->text('notes')->nullable();
            }
        });

        // 2. Staff roles table & RBAC permissions
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('label');
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('label');
                $table->string('module');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('role_has_permissions')) {
            Schema::create('role_has_permissions', function (Blueprint $table) {
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
                $table->primary(['role_id', 'permission_id']);
            });
        }

        if (!Schema::hasTable('user_has_roles')) {
            Schema::create('user_has_roles', function (Blueprint $table) {
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->string('user_type');
                $table->unsignedBigInteger('user_id');
                $table->primary(['role_id', 'user_type', 'user_id']);
            });
        }

        // 3. New Staff tables
        if (!Schema::hasTable('receptionists')) {
            Schema::create('receptionists', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nurses')) {
            Schema::create('nurses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('accountants')) {
            Schema::create('accountants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pharmacists')) {
            Schema::create('pharmacists', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('store_staff')) {
            Schema::create('store_staff', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('hr_staff')) {
            Schema::create('hr_staff', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->boolean('status')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // 4. OPD Token Queue System
        if (!Schema::hasTable('opd_tokens')) {
            Schema::create('opd_tokens', function (Blueprint $table) {
                $table->id();
                $table->integer('token_number');
                $table->date('token_date');
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
                $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
                $table->string('token_type')->default('standard');
                $table->string('status')->default('waiting');
                $table->decimal('consultation_fee', 10, 2)->default(0);
                $table->string('payment_status')->default('paid');
                $table->integer('priority_level')->default(1);
                $table->timestamp('called_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        // 5. IPD Wards, Beds & Admissions
        if (!Schema::hasTable('wards')) {
            Schema::create('wards', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('ward_type')->default('general');
                $table->string('floor_number')->nullable();
                $table->decimal('daily_charge', 10, 2)->default(0);
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('beds')) {
            Schema::create('beds', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ward_id')->constrained('wards')->onDelete('cascade');
                $table->string('bed_number');
                $table->string('bed_type')->default('standard');
                $table->string('status')->default('available');
                $table->decimal('daily_charge', 10, 2)->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('admissions')) {
            Schema::create('admissions', function (Blueprint $table) {
                $table->id();
                $table->string('admission_number')->nullable();
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
                $table->foreignId('ward_id')->nullable()->constrained('wards')->onDelete('set null');
                $table->foreignId('bed_id')->nullable()->constrained('beds')->onDelete('set null');
                $table->dateTime('admission_date');
                $table->dateTime('discharge_date')->nullable();
                $table->text('admission_reason')->nullable();
                $table->string('emergency_contact_name')->nullable();
                $table->string('emergency_contact_phone')->nullable();
                $table->decimal('advance_amount', 10, 2)->default(0);
                $table->string('status')->default('admitted');
                $table->string('discharge_reason')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('patient_transfers')) {
            Schema::create('patient_transfers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('admission_id')->constrained('admissions')->onDelete('cascade');
                $table->foreignId('from_bed_id')->nullable()->constrained('beds')->onDelete('set null');
                $table->foreignId('to_bed_id')->constrained('beds')->onDelete('cascade');
                $table->dateTime('transfer_date');
                $table->text('reason')->nullable();
                $table->unsignedBigInteger('transferred_by')->nullable();
                $table->timestamps();
            });
        }

        // 6. Prescriptions
        if (!Schema::hasTable('prescriptions')) {
            Schema::create('prescriptions', function (Blueprint $table) {
                $table->id();
                $table->string('prescription_number')->nullable();
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
                $table->dateTime('prescription_date');
                $table->text('chief_complaints')->nullable();
                $table->text('diagnosis')->nullable();
                $table->text('advice')->nullable();
                $table->date('follow_up_date')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('prescription_items')) {
            Schema::create('prescription_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('prescription_id')->constrained('prescriptions')->onDelete('cascade');
                $table->unsignedBigInteger('medicine_id')->nullable();
                $table->string('medicine_name');
                $table->string('dosage')->nullable();
                $table->string('frequency')->nullable();
                $table->string('duration')->nullable();
                $table->text('instructions')->nullable();
                $table->timestamps();
            });
        }

        // 7. Nurse Vitals & Notes
        if (!Schema::hasTable('patient_vitals')) {
            Schema::create('patient_vitals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->unsignedBigInteger('admission_id')->nullable();
                $table->dateTime('recorded_at');
                $table->integer('bp_systolic')->nullable();
                $table->integer('bp_diastolic')->nullable();
                $table->integer('pulse_rate')->nullable();
                $table->decimal('temperature', 4, 1)->nullable();
                $table->integer('spo2')->nullable();
                $table->integer('respiration_rate')->nullable();
                $table->decimal('weight', 5, 2)->nullable();
                $table->decimal('height', 5, 2)->nullable();
                $table->decimal('blood_sugar', 6, 2)->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nursing_notes')) {
            Schema::create('nursing_notes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->unsignedBigInteger('admission_id')->nullable();
                $table->unsignedBigInteger('nurse_id')->nullable();
                $table->text('note');
                $table->dateTime('recorded_at');
                $table->timestamps();
            });
        }

        // 8. Discharge Summaries
        if (!Schema::hasTable('discharge_summaries')) {
            Schema::create('discharge_summaries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('admission_id')->constrained('admissions')->onDelete('cascade');
                $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
                $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
                $table->dateTime('discharge_date');
                $table->string('discharge_type')->default('regular');
                $table->text('admission_reason')->nullable();
                $table->text('final_diagnosis');
                $table->text('treatment_summary')->nullable();
                $table->text('discharge_condition')->nullable();
                $table->text('discharge_medications')->nullable();
                $table->text('advice_instructions')->nullable();
                $table->date('follow_up_date')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        // 9. Pharmacy & Medicine Master
        if (!Schema::hasTable('medicine_categories')) {
            Schema::create('medicine_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('medicines')) {
            Schema::create('medicines', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->nullable()->constrained('medicine_categories')->onDelete('set null');
                $table->string('name');
                $table->string('generic_name')->nullable();
                $table->string('manufacturer')->nullable();
                $table->string('batch_number')->nullable();
                $table->decimal('purchase_price', 10, 2)->default(0);
                $table->decimal('unit_price', 10, 2)->default(0);
                $table->integer('stock_quantity')->default(0);
                $table->integer('reorder_level')->default(10);
                $table->date('expiry_date')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pharmacy_invoices')) {
            Schema::create('pharmacy_invoices', function (Blueprint $table) {
                $table->id();
                $table->string('invoice_number')->unique();
                $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('set null');
                $table->string('customer_name')->nullable();
                $table->string('customer_phone')->nullable();
                $table->decimal('total_amount', 10, 2)->default(0);
                $table->decimal('discount_amount', 10, 2)->default(0);
                $table->decimal('tax_amount', 10, 2)->default(0);
                $table->decimal('net_amount', 10, 2)->default(0);
                $table->decimal('paid_amount', 10, 2)->default(0);
                $table->string('payment_status')->default('paid');
                $table->string('payment_mode')->default('cash');
                $table->unsignedBigInteger('sold_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pharmacy_invoice_items')) {
            Schema::create('pharmacy_invoice_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pharmacy_invoice_id')->constrained('pharmacy_invoices')->onDelete('cascade');
                $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade');
                $table->string('medicine_name');
                $table->decimal('unit_price', 10, 2);
                $table->integer('quantity');
                $table->decimal('total_price', 10, 2);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('medicine_returns')) {
            Schema::create('medicine_returns', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pharmacy_invoice_id')->constrained('pharmacy_invoices')->onDelete('cascade');
                $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade');
                $table->integer('quantity');
                $table->decimal('refund_amount', 10, 2);
                $table->text('reason')->nullable();
                $table->unsignedBigInteger('returned_by')->nullable();
                $table->timestamps();
            });
        }

        // 10. Inventory & Suppliers
        if (!Schema::hasTable('inventory_suppliers')) {
            Schema::create('inventory_suppliers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('company_name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->text('address')->nullable();
                $table->string('gstin')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('inventory_items')) {
            Schema::create('inventory_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('supplier_id')->nullable()->constrained('inventory_suppliers')->onDelete('set null');
                $table->string('item_name');
                $table->string('item_code');
                $table->string('category')->default('General');
                $table->integer('quantity')->default(0);
                $table->string('unit')->default('pcs');
                $table->integer('min_reorder_level')->default(5);
                $table->decimal('unit_price', 10, 2)->default(0);
                $table->string('location_rack')->nullable();
                $table->timestamps();
            });
        }

        // 11. Accounting & Expenses
        if (!Schema::hasTable('expense_categories')) {
            Schema::create('expense_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('expenses')) {
            Schema::create('expenses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->onDelete('set null');
                $table->string('title');
                $table->decimal('amount', 10, 2);
                $table->date('expense_date');
                $table->string('payment_mode')->default('cash');
                $table->string('vendor_name')->nullable();
                $table->string('reference_no')->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('daily_cash_closings')) {
            Schema::create('daily_cash_closings', function (Blueprint $table) {
                $table->id();
                $table->date('closing_date')->unique();
                $table->decimal('opening_balance', 10, 2)->default(0);
                $table->decimal('total_opd_collected', 10, 2)->default(0);
                $table->decimal('total_pharmacy_collected', 10, 2)->default(0);
                $table->decimal('total_ipd_collected', 10, 2)->default(0);
                $table->decimal('total_expenses', 10, 2)->default(0);
                $table->decimal('closing_balance', 10, 2)->default(0);
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('closed_by')->nullable();
                $table->timestamps();
            });
        }

        // 12. Centralized Audit Log & System Notifications
        if (!Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->id();
                $table->string('user_type')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('action');
                $table->string('module');
                $table->string('record_id')->nullable();
                $table->text('description')->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('system_notifications')) {
            Schema::create('system_notifications', function (Blueprint $table) {
                $table->id();
                $table->string('recipient_type')->default('all');
                $table->unsignedBigInteger('recipient_id')->nullable();
                $table->string('title');
                $table->text('message');
                $table->string('type')->default('info');
                $table->string('link')->nullable();
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('system_notifications');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('daily_cash_closings');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('expense_categories');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('inventory_suppliers');
        Schema::dropIfExists('medicine_returns');
        Schema::dropIfExists('pharmacy_invoice_items');
        Schema::dropIfExists('pharmacy_invoices');
        Schema::dropIfExists('medicines');
        Schema::dropIfExists('medicine_categories');
        Schema::dropIfExists('discharge_summaries');
        Schema::dropIfExists('nursing_notes');
        Schema::dropIfExists('patient_vitals');
        Schema::dropIfExists('prescription_items');
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('patient_transfers');
        Schema::dropIfExists('admissions');
        Schema::dropIfExists('beds');
        Schema::dropIfExists('wards');
        Schema::dropIfExists('opd_tokens');
        Schema::dropIfExists('hr_staff');
        Schema::dropIfExists('store_staff');
        Schema::dropIfExists('pharmacists');
        Schema::dropIfExists('accountants');
        Schema::dropIfExists('nurses');
        Schema::dropIfExists('receptionists');
        Schema::dropIfExists('user_has_roles');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
