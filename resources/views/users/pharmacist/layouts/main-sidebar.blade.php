@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">Main</li>
    <li class="slide">
        <a class="side-menu__item" href="{{ route('pharmacist.dashboard') }}">
            <i class="fe fe-home side-menu__icon"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>

    <li class="side-item side-item-category">Pharmacy</li>

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
@endsection
