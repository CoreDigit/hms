@extends('users.layouts.main-sidebar')

@section('side-menu')
    <li class="side-item side-item-category">{{ __('general.words.main') }}</li>

    <li class="slide">
        <a class="side-menu__item" href="{{ route('rayEmployee.dashboard') }}">
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
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3" />
                <path
                    d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z" />
            </svg>
            <span class="side-menu__label">{{ __('cruds.rays') }}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li>
                <a class="slide-item" href="{{ route('rayEmployee.rays.index', 'all') }}">
                    {{ __('statistics.all.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('rayEmployee.rays.index', 'pending') }}">
                    {{ __('statistics.pending.') }}
                </a>
            </li>
            <li>
                <a class="slide-item" href="{{ route('rayEmployee.rays.index', 'completed') }}">
                    {{ __('statistics.completed.') }}
                </a>
            </li>
        </ul>
    </li>
@endsection
