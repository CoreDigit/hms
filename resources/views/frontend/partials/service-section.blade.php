<section class="services-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>{{ __('general.words.service_section.') }}</h2>
            <div class="separator"></div>
        </div>

        @php
            $icons = ['icon flaticon-doctor-stethoscope', 'icon flaticon-operating-room', 'icon flaticon-van', 'icon flaticon-water', 'icon flaticon-pharmacy', 'icon flaticon-nurse'];
        @endphp

        <div class="row clearfix">
            <!-- Left Column -->
            <div class="left-column pull-left col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Service Block -->
                    @for ($i = 0; $i < 3; $i++)
                        <div class="service-block">
                            <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
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

            <!-- Circles Column -->
            <div class="circles-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">

                    <div class="circles">
                        <div class="circle-one"></div>
                        <div class="circle-two"></div>
                        <div class="circle-three"></div>
                    </div>

                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column pull-right col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Service Block -->
                    @for ($i = 3; $i < 6; $i++)
                        <div class="service-block-two">
                            <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
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
        </div>
    </div>
</section>
