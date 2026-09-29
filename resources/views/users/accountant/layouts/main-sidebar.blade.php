@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">Main</li>
    <li class="slide">
        <a class="side-menu__item" href="{{ route('accountant.dashboard') }}">
            <i class="fe fe-home side-menu__icon"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>

    <li class="side-item side-item-category">Financials</li>

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

    <li class="slide">
        <a class="side-menu__item" href="{{ route('accountant.payments.index') }}">
            <i class="fe fe-dollar-sign side-menu__icon"></i>
            <span class="side-menu__label">Payments</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('accountant.receipts.index') }}">
            <i class="fe fe-credit-card side-menu__icon"></i>
            <span class="side-menu__label">Receipts</span>
        </a>
    </li>
@endsection
