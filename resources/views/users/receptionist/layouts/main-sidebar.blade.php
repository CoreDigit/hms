@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">Main</li>
    <li class="slide">
        <a class="side-menu__item" href="{{ route('receptionist.dashboard') }}">
            <i class="fe fe-home side-menu__icon"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>

    <li class="side-item side-item-category">Reception Desk</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('receptionist.patients.index') }}">
            <i class="fe fe-user-plus side-menu__icon"></i>
            <span class="side-menu__label">Patient Registration</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="fe fe-users side-menu__icon"></i>
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
@endsection
