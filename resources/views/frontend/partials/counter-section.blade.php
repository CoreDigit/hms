<section class="counter-section" style="background-image: url({{ asset('frontend/assets/images/background/pattern-3.png') }})">
    <div class="auto-container">
        <!-- Fact Counter -->
        <div class="fact-counter">
            <div class="row clearfix">
                <!--Column-->
                <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="2500" data-stop="{{ $count['patients'] }}">0</span>
                            </div>
                            <h4 class="counter-title">{{ __('users.patients') }}</h4>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="count-outer count-box alternate">
                                +<span class="count-text" data-speed="3000" data-stop="{{ $count['doctors'] }}">0</span>
                            </div>
                            <h4 class="counter-title">{{ __('users.doctors') }}</h4>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="{{ $count['departments'] }}">0</span>
                            </div>
                            <h4 class="counter-title">{{ __('cruds.departments') }}</h4>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="count-outer count-box">
                                +<span class="count-text" data-speed="2500" data-stop="{{ $count['services'] }}">0</span>
                            </div>
                            <h4 class="counter-title">{{ __('cruds.services.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
