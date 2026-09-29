<section class="doctor-detail">
    <div class="auto-container">
        <!-- Upper Box -->
        <div class="upper-box">
            <div class="row clearfix">
                <div class="detail-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="info-header">
                            <p>{{ __('general.words.doctor_section.0') }}</p>
                            <h3>
                                {{ __('general.words.imdr') . $doctor->name }}
                            </h3>
                            <span class="designation">
                                {{ $doctor->specialty }}
                            </span>
                        </div>
                        <ul class="info-list">
                            <li>
                                <strong>{{ __('cruds.department') }}</strong>
                                <p>{{ $doctor->department->name }}</p>
                            </li>
                            <li>
                                <strong>{{ __('cruds.education') }}</strong>
                                <p>{{ $doctor->education }}</p>
                            </li>
                            <li>
                                <strong>{{ __('cruds.experience') }}</strong>
                                <p>{{ $doctor->experience }}</p>
                            </li>
                            <li>
                                <strong>{{ __('field.bio') }}</strong>
                                <p>{{ $doctor->bio }}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="image-box col-lg-4 col-md-12 col-sm-12">
                    <div class="image">
                        <a href="{{ asset('backend/images/' . $doctor->image->path) }}" class="lightbox-image">
                            <img src="{{ asset('backend/images/' . $doctor->image->path) }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lower Content -->
        <div class="lower-content">
            <div class="row clearfix">
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="appointment-form">
                            <div class="sec-title centered">
                                <h2>{{ __('cruds.appointment') }}</h2>
                                <p>{{ __('general.words.doctor_section.1') }}</p>
                            </div>

                            <!-- Appointment Form -->
                            @if (auth()->guard('patient')->check())
                                @livewire('web.create-appointment-with-doctor', [
                                    'patient_id' => auth()->guard('patient')->user()->id,
                                    'doctor_id' => $doctor->id,
                                ])
                            @else
                                <div class="alert alert-warning">{{ __('validation.patient') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <ul class="contact-list">
                            <li>
                                <span>{{ __('field.email') }}:</span>{{ $doctor->email }}
                            </li>
                            <li>
                                <span>{{ __('field.phone') }}:</span>{{ $doctor->phone }}
                            </li>
                            <li>
                                <span>{{ __('const.gender.') }}:</span>
                                {{ $doctor->gender ? __('const.gender.male') : __('const.gender.female') }}
                            </li>
                            <li>
                                <span>{{ __('cruds.profession') }}:</span>{{ $doctor->specialty }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
