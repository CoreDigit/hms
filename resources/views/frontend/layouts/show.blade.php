@extends('frontend.layouts.master')

@section('title')
    HMS | @yield('title1') | @yield('title2')
@endsection

@section('content')
    <section class="page-title" style="background-image:url({{ asset('frontend/assets/images/background/7.webp') }});">
        <div class="auto-container">
            <h1>@yield('title2')</h1>
            <div class="text">{{ __('general.words.detail') }}</div>
            <ul class="bread-crumb clearfix">
                <li>
                    <a href="{{ route('web.index') }}">
                        <span class="fas fa-home"></span>
                        {{ __('general.words.home') }}
                    </a>
                </li>
                <li>
                    <a href="@yield('title1-link')">
                        @yield('title1')
                    </a>
                </li>
                <li>@yield('title2')</li>
            </ul>
        </div>
    </section>

    @yield('content+')
@endsection
