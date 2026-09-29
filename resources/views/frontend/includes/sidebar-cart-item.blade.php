<div class="xs-sidebar-group info-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">
                    X
                </a>
            </div>
            <div class="sidebar-textwidget">
                <!-- Sidebar Info Content -->
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="{{ route('web.index') }}">
                                <img style="width: 150px" src="{{ asset('frontend/assets/images/logo.png') }}" alt="HMS" />
                            </a>
                        </div>
                        <div class="content-box">
                            <h2>{{ __('general.about.us') }}</h2>
                            <p class="text">{{ __('general.text.sidebar_cart_item') }}</p>
                            <a href="{{ route('web.contacts.create') }}" class="theme-btn btn-style-two">
                                <span class="txt">{{ __('general.contact.') }}</span>
                            </a>
                        </div>
                        <div class="contact-info">
                            <h2>{{ __('general.contact.info') }}</h2>
                            <ul class="list-style-two">
                                <li>
                                    <span class="icon flaticon-map"></span>
                                    {{ __('general.contact.address.0') }} | {{ __('general.contact.address.1') }}
                                </li>
                                <li>
                                    <span class="icon flaticon-telephone"></span>
                                    +20 1026264486
                                </li>
                                <li>
                                    <span class="icon flaticon-message-1"></span>
                                    zyadgamal450@gmail.com
                                </li>
                                <li>
                                    <span class="icon flaticon-timetable"></span>
                                    {{ __('general.contact.week_days') }}
                                </li>
                            </ul>
                        </div>
                        <!-- Social Box -->
                        <ul class="social-box">@include('frontend.partials.social-links')</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
