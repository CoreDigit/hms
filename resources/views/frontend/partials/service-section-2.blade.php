<section class="services-section-two style-two">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>{{ __('general.words.service_section.') }}</h2>
            <div class="separator"></div>
        </div>

        @php
            $icons = ['icon flaticon-stethoscope', 'icon flaticon-operating-room', 'icon flaticon-van', 'icon flaticon-water', 'icon flaticon-pharmacy', 'icon flaticon-nurse'];
        @endphp

        <div class="row clearfix">
            <!-- Services Block Three -->
            @for ($i = 0; $i < 6; $i++)
                <div class="service-block-three col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="border-one"></div>
                        <div class="border-two"></div>
                        <div class="icon-box">
                            <span class="{{ $icons[$i] }}"></span>
                        </div>
                        <h3>
                            {{ __('general.words.service_section.' . $i) }}
                        </h3>
                        <div class="text">
                            {!! __('general.text.service_section.' . $i) !!}
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>
