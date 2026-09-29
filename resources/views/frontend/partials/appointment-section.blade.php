<section class="Xappointment-section-two">
    <!-- Note: I cancelled the section class to not be above the top section -->
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="{{ asset('frontend/assets/images/resource/4.png') }}" alt="" />
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="form-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>{{ __('cruds.appointment') }}</h2>
                            <div class="separator"></div>
                        </div>

                        <!-- Appointment Form -->
                        @if (auth()->guard('patient')->check())
                            @livewire('web.create-appointment', ['patient_id' => auth()->guard('patient')->user()->id])
                        @else
                            <div class="alert alert-warning">{{ __('validation.patient') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
