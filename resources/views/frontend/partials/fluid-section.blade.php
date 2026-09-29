<section class="fluid-section-one">
    <div class="outer-section clearfix">

        <!--Image Column-->
        <div class="image-column"
            style="background-image: url({{ asset('frontend/assets/images/resource/image-1.jpg') }})">
            <div class="image">
                <img src="{{ asset('frontend/assets/images/resource/image-1.jpg') }}" alt="">
            </div>
        </div>
        <!--End Image Column-->

        <!--Content Column-->
        <div class="content-column">
            <div class="content-box">
                <div class="sec-title">
                    <h2>{{ __('general.text.fluid_section.0') }}</h2>
                    <div class="separator style-two"></div>
                </div>
                <div class="text">
                    <p>{{ __('general.text.fluid_section.1') }}</p>
                    <p>{{ __('general.text.fluid_section.2') }}</p>
                </div>
                <div class="row clearfix">
                    <div class="column col-lg-6 col-md-6 col-sm-12">
                        <ul class="list-style-one">
                            <li>
                                <span class="icon flaticon-medical-stethoscope-variant"></span>
                                {{ __('general.words.fluid_section.0') }}
                            </li>
                            <li>
                                <span class="icon flaticon-doctor"></span>
                                {{ __('general.words.fluid_section.1') }}
                            </li>
                        </ul>
                    </div>
                    <div class="column col-lg-6 col-md-6 col-sm-12">
                        <ul class="list-style-one">
                            <li>
                                <span class="icon flaticon-ambulance-side-view"></span>
                                {{ __('general.words.fluid_section.2') }}
                            </li>
                            <li>
                                <span class="icon flaticon-medical-kit"></span>
                                {{ __('general.words.fluid_section.3') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
