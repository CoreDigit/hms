<section class="team-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>{{ __('general.words.team_section') }}</h2>
            <div class="separator"></div>
        </div>

        <div class="row clearfix">
            @foreach ($doctors as $doctor)
                <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="{{ asset('backend/images/' . $doctor->image->path) }}" alt="" />
                            <div class="overlay-box">
                                <a href="{{ route('web.doctors.show', $doctor->id) }}" class="appointment">
                                    {{ __('cruds.appointment') }}
                                </a>
                            </div>
                        </div>
                        <div class="lower-content">
                            <h3>
                                <a href="{{ route('web.doctors.show', $doctor->id) }}">
                                    {{ __('general.words.dr') . $doctor->name }}
                                </a>
                            </h3>
                            <div class="designation">
                                {{ $doctor->specialist }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if (Route::currentRouteName() === 'web.doctors.index')
            <div class="pagination justify-content-center">
                {{ $doctors->links() }}
            </div>
        @endif
    </div>
</section>
