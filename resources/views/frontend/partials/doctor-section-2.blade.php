<section class="doctors-section style-three">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>{{ __('general.words.department_doctors') }}</h2>
            <div class="separator"></div>
        </div>

        <!-- Features Tab -->
        @if ($departmentDoctors->count())
            <div class="doctors-tabs tabs-box">
                <ul class="doctors-thumb tab-buttons clearfix">
                    @foreach ($departmentDoctors->take(2) as $doctor)
                        <li data-tab="#doctor-{{ $doctor->id }}" class="tab-btn {{ $loop->first ? 'active-btn' : '' }}">
                            <div class="image-box">
                                <figure>
                                    <img src="{{ asset('backend/images/' . $doctor->image->path) }}" alt="">
                                </figure>
                            </div>
                        </li>
                    @endforeach
                    @if ($departmentDoctors->count() > 2)
                        <li>
                            <a href="{{ route('web.doctors.index') }}">
                                {{ __('handle.show.more') }}
                            </a>
                        </li>
                    @endif
                </ul>

                <!--Tabs Container-->
                <div class="tabs-content">
                    <!--Tab / Active Tab-->
                    @foreach ($departmentDoctors as $doctor)
                        <div class="doctor-info tab {{ $loop->first ? 'active-tab' : '' }}"
                            id="doctor-{{ $doctor->id }}">
                            <div class="row clearfix">
                                <!-- Image-column -->
                                <div class="image-column col-lg-5 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="image-box">
                                            <a href="{{ asset('backend/images/' . $doctor->image->path) }}"
                                                class="lightbox-image" data-fancybox="Gallery">
                                                <img src="{{ asset('backend/images/' . $doctor->image->path) }}"alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image-column -->
                                <div class="content-column col-lg-5 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <h3 class="name">
                                            <a href="{{ route('web.doctors.show', $doctor->id) }}">
                                                {{ __('general.words.dr') . $doctor->name }}
                                            </a>
                                        </h3>
                                        <span class="designation">{{ $doctor->specialty }}</span>
                                        <p>{{ $doctor->education }}</p>
                                        <p>{{ $doctor->experience }}</p>
                                        <p>{{ $doctor->bio }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h4 class="text-center">{{ __('general.warning.no_doctors') }}</h4>
        @endif
    </div>
</section>
