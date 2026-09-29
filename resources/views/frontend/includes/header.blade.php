<header class="main-header">
    <!--Header Top-->
    <div class="header-top">
        <div class="auto-container clearfix">
            <div class="top-left clearfix">
                <ul class="list">
                    <li>
                        <span class="icon fas fa-envelope"></span>
                        {{ __('general.contact.address.0') }} | {{ __('general.contact.address.1') }}
                    </li>
                    <li>
                        <span class="icon fas fa-phone"></span>
                        <a href="tel:+20 1026264486">+20 1026264486</a>
                    </li>
                </ul>
            </div>

            <div class="top-right clearfix">
                <ul class="social-icons">@include('frontend.partials.social-links')</ul>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header Upper -->
    <div class="header-upper">
        <div class="inner-container">
            <div class="auto-container clearfix">
                <!--Info-->
                <div class="logo-outer">
                    <div class="logo">
                        <a href="{{ route('web.index') }}">
                            <img style="width: 150px" src="{{ asset('frontend/assets/images/logo.png') }}"
                                alt="HMS" />
                        </a>
                    </div>
                </div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler For Mobile-->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="navbar-header">
                            <!-- Togg le Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon flaticon-menu"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">@include('frontend.partials.nav-links')</ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <!-- Main Menu End-->
                    <div class="outer-box clearfix">
                        <!-- Search Btn -->
                        {{-- <div class="search-box-btn"><span class="icon flaticon-search"></span></div> --}}
                        <!-- Button Box -->
                        <div class="btn-box">
                            <a href="{{ route('web.appointments.create') }}" class="theme-btn btn-style-one">
                                <span class="txt">{{ __('cruds.appointment') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="{{ route('web.index') }}">
                    <img style="width: 100px" src="{{ asset('frontend/assets/images/logo.png') }}" alt="HMS" />
                </a>
            </div>

            <!--Right Col-->
            <div class="right-col pull-right">
                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md">
                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
                        <ul class="navigation clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </ul>
                    </div>
                </nav><!-- Main Menu End-->
            </div>

        </div>
    </div>
    <!--End Sticky Header-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon far fa-window-close"></span></div>

        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ route('web.index') }}">
                    <img style="width: 150px" src="{{ asset('frontend/assets/images/logo.png') }}" alt="HMS" />
                </a>
            </div>

            <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
