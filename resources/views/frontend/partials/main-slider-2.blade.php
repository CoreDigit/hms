<section class="main-slider-three">
    <div class="banner-carousel">
        @php
            $images = ['4.png', '4.png', '4.png'];
        @endphp

        <!-- Swiper -->
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 3; $i++)
                <div class="swiper-slide slide">
                    <div class="auto-container">
                        <div class="row clearfix">
                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h2>{{ __('general.text.main_slider.3') }}</h2>
                                    <div class="text">{{ __('general.text.main_slider.4') }}</div>
                                    <div class="btn-box">
                                        <a href="{{ route('web.appointments.create') }}"
                                            class="theme-btn appointment-btn">
                                            <span class="txt">{{ __('cruds.appointment') }}</span>
                                        </a>
                                        <a href="{{ route('web.services.index') }}" class="theme-btn services-btn">
                                            {{ __('cruds.services.') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="{{ asset('frontend/assets/images/main-slider/' . $images[$i]) }}"
                                            alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
