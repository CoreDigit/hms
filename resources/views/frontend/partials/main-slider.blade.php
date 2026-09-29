<section class="main-slider">
    <div class="banner-carousel">
        <!-- Swiper -->
        <div class="swiper-wrapper">
            <div class="swiper-slide slide"
                style="background-image:url({{ asset('frontend/assets/images/main-slider/1.jpg') }})">
                <div class="auto-container">
                    <div class="content clearfix">
                        <div class="title">{{ __('general.text.main_slider.0') }}</div>
                        <h2>{{ __('general.text.main_slider.1') }}</h2>
                        <div class="text">{{ __('general.text.main_slider.2') }} :</div>
                        <div class="btn-box clearfix">
                            <a href="{{ route('web.services.index') }}" class="theme-btn btn-style-two">
                                <span class="txt">{{ __('cruds.services.') }}</span>
                            </a>
                            <a href="contact.html" class="theme-btn phone-btn">
                                <span class="icon flaticon-call"></span>
                                +20 1026264486
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide"
                style="background-image:url({{ asset('frontend/assets/images/main-slider/2.jpg') }})">
                <div class="auto-container">
                    <div class="content clearfix">
                        <div class="title">{{ __('general.text.main_slider.0') }}</div>
                        <h2>{{ __('general.text.main_slider.1') }}</h2>
                        <div class="text">{{ __('general.text.main_slider.2') }} :</div>
                        <div class="btn-box clearfix">
                            <a href="{{ route('web.services.index') }}" class="theme-btn btn-style-two">
                                <span class="txt">{{ __('cruds.services.') }}</span>
                            </a>
                            <a href="contact.html" class="theme-btn phone-btn">
                                <span class="icon flaticon-call"></span>
                                +20 1026264486
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide"
                style="background-image:url({{ asset('frontend/assets/images/main-slider/3.jpg') }})">
                <div class="auto-container">
                    <div class="content clearfix">
                        <div class="title">{{ __('general.text.main_slider.0') }}</div>
                        <h2>{{ __('general.text.main_slider.1') }}</h2>
                        <div class="text">{{ __('general.text.main_slider.2') }} :</div>
                        <div class="btn-box clearfix">
                            <a href="contact.html" class="theme-btn btn-style-two">
                                <span class="txt">{{ __('cruds.services.') }}</span>
                            </a>
                            <a href="contact.html" class="theme-btn phone-btn">
                                <span class="icon flaticon-call"></span>
                                +20 1026264486
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
