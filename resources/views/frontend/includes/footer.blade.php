<footer class="main-footer style-two">
    <!-- Note: style-two for master 2 -->
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">
                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <div class="logo">
                            <a href="{{ route('web.index') }}">
                                <img style="width: 150px" src="{{ asset('frontend/assets/images/logo.png') }}"
                                    alt="HMS" />
                            </a>
                        </div>
                        <div class="text">{{ __('general.text.footer') }}</div>
                        <ul class="social-icons">@include('frontend.partials.social-links')</ul>
                    </div>
                </div>

                @php
                    $departments = App\Models\Cruds\Department::take(6)->get();
                @endphp

                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget links-widget">
                        <div class="footer-title  clearfix">
                            <h2>{{ __('cruds.departments') }}</h2>
                            <div class="separator"></div>
                        </div>
                        <ul class="footer-list">
                            @foreach ($departments as $department)
                                <li>
                                    <a href="{{ route('web.departments.show', $department->id)}}">
                                        {{ $department->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget contact-widget">
                        <div class="footer-title  clearfix">
                            <h2>{{ __('general.contact.us') }}</h2>
                            <div class="separator"></div>
                        </div>

                        <ul class="contact-list">
                            <li>
                                <span class="icon flaticon-placeholder"></span>
                                {{ __('general.contact.address.0') }}
                                <br>
                                {{ __('general.contact.address.1') }}
                            </li>
                            <li>
                                <span class="icon flaticon-call"></span>
                                {{ __('general.contact.time') }} : 08:30 - 18:00
                                <br>
                                <a href="tel:+20 1026264486">+20 1026264486</a>
                            </li>
                            <li>
                                <span class="icon flaticon-message"></span>
                                {{ __('general.contact.question') }}
                                <a ref="mailto:zyadgamal450@gmail.com">zyadgamal450@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright">
                {{ __('general.project.name')}} &copy; Ziad Gamal
            </div>
        </div>
    </div>
</footer>
