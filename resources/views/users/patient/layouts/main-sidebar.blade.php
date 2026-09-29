@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">{{ __('general.words.main') }}</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('patient.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                <path
                    d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
            </svg>
            <span class="side-menu__label">{{ __('general.dashboard.') }}</span>
        </a>
    </li>

    <li class="side-item side-item-category">{{ __('general.words.general') }}</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('patient.doctors.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 4c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-7 0c.83 0 1.5.67 1.5 1.5S9.33 11 8.5 11 7 10.33 7 9.5 7.67 8 8.5 8zm3.5 9.5c-2.33 0-4.32-1.45-5.12-3.5h1.67c.7 1.19 1.97 2 3.45 2s2.76-.81 3.45-2h1.67c-.8 2.05-2.79 3.5-5.12 3.5z"
                    opacity=".3" />
                <circle cx="15.5" cy="9.5" r="1.5" />
                <circle cx="8.5" cy="9.5" r="1.5" />
                <path
                    d="M12 16c-1.48 0-2.75-.81-3.45-2H6.88c.8 2.05 2.79 3.5 5.12 3.5s4.32-1.45 5.12-3.5h-1.67c-.69 1.19-1.97 2-3.45 2zm-.01-14C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
            </svg>
            <span class="side-menu__label">{{ __('general.words.my.doctors') }}</span>
            <span class="badge badge-success side-badge">{{ $statistics['all']['doctors'] }}</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"
                    opacity=".3" />
                <path
                    d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
            </svg>
            <span class="side-menu__label">{{ __('cruds.services.') }}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li>
                <a class="slide-item" href="{{ route('patient.single-services.index') }}">
                    {{ __('cruds.services.single') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('patient.multi-services.index') }}">
                    {{ __('cruds.services.multi') }}
                </a>
            </li>
        </ul>
    </li>

    <li class="side-item side-item-category">{{ __('general.words.medical_fields') }}</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('patient.records') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M20,2H4C2.9,2,2,2.9,2,4v16c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V4C22,2.9,21.1,2,20,2z M20,20H4V4h16V20z M13,15H6c-0.55,0-1,0.45-1,1s0.45,1,1,1h7c0.55,0,1-0.45,1-1S13.55,15,13,15z M18,10H6v2h12V10z"
                />
            </svg>
            <span class="side-menu__label">{{ __('general.words.my.records') }}</span>
            <span class="badge badge-danger side-badge">{{ __('general.words.new') }}</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M20 0H4C2.9 0 2 .9 2 2v20c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V2c0-1.1-.9-2-2-2zm0 21H4V3h16v18zm-5-7h-6c-.55 0-1 .45-1 1s.45 1 1 1h6c.55 0 1-.45 1-1s-.45-1-1-1zm1-9H3v4h13V5z" />
            </svg>
            <span class="side-menu__label">{{ __('cruds.appointments') }}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li>
                <a class="slide-item" href="{{ route('patient.appointments.index', 'all') }}">
                    {{ __('statistics.all.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('patient.appointments.index', 'pending') }}">
                    {{ __('statistics.pending.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('patient.appointments.index', 'in-progress') }}">
                    {{ __('statistics.in-progress.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('patient.appointments.index', 'completed') }}">
                    {{ __('statistics.completed.') }}
                </a>
            </li>
        </ul>
    </li>

    <li class="side-item side-item-category">{{ __('general.words.financials') }}</li>
    
    <li class="slide">
        <a class="side-menu__item" href="{{ route('patient.accounts.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3" />
                <path
                    d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
            </svg>
            <span class="side-menu__label">{{ __('cruds.accounts.patient') }}</span>
        </a>
    </li>
@endsection
