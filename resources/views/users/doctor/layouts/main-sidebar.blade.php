@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">{{ __('general.words.main') }}</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('doctor.dashboard') }}">
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
        <a class="side-menu__item" href="{{ route('doctor.patients.index') }}">
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
            <span class="side-menu__label">{{ __('general.words.my.patients') }}</span>
            <span class="badge badge-success side-badge">{{ $statistics['all']['patients'] }}</span>
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
                <a class="slide-item" href="{{ route('doctor.appointments.index', 'all') }}">
                    {{ __('statistics.all.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.appointments.index', 'pending') }}">
                    {{ __('statistics.pending.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.appointments.index', 'in-progress') }}">
                    {{ __('statistics.in-progress.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.appointments.index', 'completed') }}">
                    {{ __('statistics.completed.') }}
                </a>
            </li>
        </ul>
    </li>

    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3" />
                <path
                    d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
            </svg>
            <span class="side-menu__label">{{ __('cruds.diagnostics') }}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li>
                <a class="slide-item" href="{{ route('doctor.diagnostics.index', 'all') }}">
                    {{ __('statistics.all.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.diagnostics.index', 'pending') }}">
                    {{ __('statistics.pending.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.diagnostics.index', 'in-progress') }}">
                    {{ __('statistics.in-progress.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('doctor.diagnostics.index', 'completed') }}">
                    {{ __('statistics.completed.') }}
                </a>
            </li>
        </ul>
    </li>
@endsection
