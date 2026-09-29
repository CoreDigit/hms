@extends('users.layouts.main-sidebar')

@section('side-menu')
    @if(Auth::guard('admin')->check())
        {{-------------------------------------------------- ADMIN SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">{{ __('general.words.main') }}</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">{{ __('general.dashboard.') }}</span>
            </a>
        </li>

        <li class="side-item side-item-category">{{ __('general.words.general') }}</li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">{{ __('users.users') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('doctors.index') }}">{{ __('users.doctors') }}</a></li>
                <li><a class="slide-item" href="{{ route('patients.index') }}">{{ __('users.patients') }}</a></li>
                <li><a class="slide-item" href="{{ route('labEmployees.index') }}">{{ __('users.labEmployees') }}</a></li>
                <li><a class="slide-item" href="{{ route('rayEmployees.index') }}">{{ __('users.rayEmployees') }}</a></li>
                <li><a class="slide-item" href="{{ route('ambulanceDrivers.index') }}">{{ __('users.ambulanceDrivers') }}</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-grid side-menu__icon"></i>
                <span class="side-menu__label">{{ __('cruds.services.') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('single-services.index') }}">{{ __('cruds.services.single') }}</a></li>
                <li><a class="slide-item" href="{{ route('multi-services.index') }}">{{ __('cruds.services.multi') }}</a></li>
            </ul>
        </li>

        <li class="side-item side-item-category">Hospital Modules</li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-clock side-menu__icon"></i>
                <span class="side-menu__label">OPD Queue & Tokens</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('opd_tokens.index') }}">Token List</a></li>
                <li><a class="slide-item" href="{{ route('opd_tokens.create') }}">Generate Token</a></li>
                <li><a class="slide-item" href="{{ route('opd_tokens.queue') }}" target="_blank">Live Queue Screen</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-bed side-menu__icon"></i>
                <span class="side-menu__label">IPD & Bed Management</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('beds.index') }}">Ward & Bed Grid</a></li>
                <li><a class="slide-item" href="{{ route('admissions.index') }}">IPD Admissions</a></li>
                <li><a class="slide-item" href="{{ route('admissions.create') }}">New Admission</a></li>
                <li><a class="slide-item" href="{{ route('discharge_summaries.index') }}">Discharge Summaries</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-file-text side-menu__icon"></i>
                <span class="side-menu__label">Prescriptions & Vitals</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('prescriptions.index') }}">All Prescriptions</a></li>
                <li><a class="slide-item" href="{{ route('prescriptions.create') }}">Create Prescription</a></li>
                <li><a class="slide-item" href="{{ route('nurse_vitals.index') }}">Nurse Vitals Log</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-shopping-bag side-menu__icon"></i>
                <span class="side-menu__label">Pharmacy</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('pharmacy.pos') }}">Pharmacy POS Billing</a></li>
                <li><a class="slide-item" href="{{ route('pharmacy.medicines.index') }}">Medicine Stock Master</a></li>
                <li><a class="slide-item" href="{{ route('pharmacy.invoices.index') }}">Sales Invoices</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-box side-menu__icon"></i>
                <span class="side-menu__label">Inventory</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('inventory.items.index') }}">Stock Items</a></li>
                <li><a class="slide-item" href="{{ route('inventory.suppliers.index') }}">Suppliers</a></li>
            </ul>
        </li>

        <li class="side-item side-item-category">{{ __('general.words.financials') }}</li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-dollar-sign side-menu__icon"></i>
                <span class="side-menu__label">Financials & Accounts</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('invoices.index') }}">{{ __('cruds.invoice.*') }}</a></li>
                <li><a class="slide-item" href="{{ route('receipts.index') }}">{{ __('cruds.receipt.*') }}</a></li>
                <li><a class="slide-item" href="{{ route('payments.index') }}">{{ __('cruds.payment.*') }}</a></li>
                <li><a class="slide-item" href="{{ route('patient-accounts.index') }}">{{ __('cruds.accounts.patient') }}</a></li>
                <li><a class="slide-item" href="{{ route('fund-accounts.index') }}">{{ __('cruds.accounts.fund') }}</a></li>
                <li><a class="slide-item" href="{{ route('expenses.index') }}">Expense Register</a></li>
                <li><a class="slide-item" href="{{ route('cash_closing.index') }}">Daily Cash Closing</a></li>
            </ul>
        </li>

        <li class="side-item side-item-category">System Admin</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('roles_permissions.index') }}">
                <i class="fe fe-shield side-menu__icon"></i>
                <span class="side-menu__label">Roles & Permissions</span>
            </a>
        </li>

    @elseif(Auth::guard('receptionist')->check())
        {{-------------------------------------------------- RECEPTIONIST SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Reception Desk</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('receptionist.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('patients.index') }}">
                <i class="fe fe-user-plus side-menu__icon"></i>
                <span class="side-menu__label">Patient Registration</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-clock side-menu__icon"></i>
                <span class="side-menu__label">OPD Queue & Tokens</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('receptionist.opd_tokens.index') }}">Today's Tokens</a></li>
                <li><a class="slide-item" href="{{ route('receptionist.opd_tokens.create') }}">Generate OPD Token</a></li>
                <li><a class="slide-item" href="{{ route('receptionist.opd_tokens.queue') }}" target="_blank">Queue Screen Display</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-bed side-menu__icon"></i>
                <span class="side-menu__label">IPD Admissions</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('receptionist.admissions.index') }}">Admitted Patients</a></li>
                <li><a class="slide-item" href="{{ route('receptionist.admissions.create') }}">New IPD Admission</a></li>
                <li><a class="slide-item" href="{{ route('receptionist.beds.index') }}">Bed Availability Grid</a></li>
            </ul>
        </li>

    @elseif(Auth::guard('doctor')->check())
        {{-------------------------------------------------- DOCTOR SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Doctor Portal</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('doctor.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('doctor.patients.index') }}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">My Patients</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('doctor.opd_tokens.index') }}">
                <i class="fe fe-clock side-menu__icon"></i>
                <span class="side-menu__label">OPD Queue</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-file-text side-menu__icon"></i>
                <span class="side-menu__label">Prescriptions</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('doctor.prescriptions.index') }}">Prescription History</a></li>
                <li><a class="slide-item" href="{{ route('doctor.prescriptions.create') }}">Create Prescription</a></li>
            </ul>
        </li>

    @elseif(Auth::guard('nurse')->check())
        {{-------------------------------------------------- NURSE SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Nursing Care</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('nurse.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('nurse.vitals.index') }}">
                <i class="fe fe-activity side-menu__icon"></i>
                <span class="side-menu__label">Patient Vitals & Care Notes</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('nurse.beds.index') }}">
                <i class="fe fe-bed side-menu__icon"></i>
                <span class="side-menu__label">Ward & Bed Grid</span>
            </a>
        </li>

    @elseif(Auth::guard('accountant')->check())
        {{-------------------------------------------------- ACCOUNTANT SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Accounting & Finance</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('accountant.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('accountant.expenses.index') }}">
                <i class="fe fe-minus-circle side-menu__icon"></i>
                <span class="side-menu__label">Expense Register</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('accountant.cash_closing.index') }}">
                <i class="fe fe-check-circle side-menu__icon"></i>
                <span class="side-menu__label">Daily Cash Register Closing</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('accountant.invoices.index') }}">
                <i class="fe fe-file-text side-menu__icon"></i>
                <span class="side-menu__label">Invoices</span>
            </a>
        </li>

    @elseif(Auth::guard('pharmacist')->check())
        {{-------------------------------------------------- PHARMACIST SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Pharmacy</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('pharmacist.dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('pharmacist.pos') }}">
                <i class="fe fe-shopping-cart side-menu__icon"></i>
                <span class="side-menu__label">Pharmacy POS Billing</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('pharmacist.medicines.index') }}">
                <i class="fe fe-box side-menu__icon"></i>
                <span class="side-menu__label">Medicine Stock Master</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('pharmacist.invoices.index') }}">
                <i class="fe fe-file-text side-menu__icon"></i>
                <span class="side-menu__label">Sales Invoices</span>
            </a>
        </li>

    @else
        {{-------------------------------------------------- DEFAULT / PATIENT SIDEBAR --------------------------------------------------}}
        <li class="side-item side-item-category">Patient Portal</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ url('patient/dashboard') }}">
                <i class="fe fe-home side-menu__icon"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
    @endif
@endsection
