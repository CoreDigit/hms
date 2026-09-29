@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">Main</li>
    <li class="slide">
        <a class="side-menu__item" href="{{ route('nurse.dashboard') }}">
            <i class="fe fe-home side-menu__icon"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>

    <li class="side-item side-item-category">Nursing Care</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('nurse.vitals.index') }}">
            <i class="fe fe-activity side-menu__icon"></i>
            <span class="side-menu__label">Patient Vitals & Notes</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('nurse.beds.index') }}">
            <i class="fe fe-grid side-menu__icon"></i>
            <span class="side-menu__label">Ward & Bed Grid</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('nurse.admissions.index') }}">
            <i class="fe fe-users side-menu__icon"></i>
            <span class="side-menu__label">IPD Admitted Patients</span>
        </a>
    </li>
@endsection
