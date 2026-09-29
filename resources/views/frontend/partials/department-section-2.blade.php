<section class="department-section-two style-two">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>{{ __('general.words.health_department') }}</h2>
            <div class="separator"></div>
        </div>

        <div class="three-item-carousel owl-carousel owl-theme">
            <!-- Department Block Two -->
            @foreach ($departments as $department)
                <div class="department-block-two">
                    <div class="inner-box">
                        <div class="image">
                            <a href="{{ asset('backend/images/' . $department->image->path) }}" class="lightbox-image">
                                <img src="{{ asset('backend/images/' . $department->image->path) }}" alt="" />
                            </a>
                        </div>
                        <div class="lower-content">
                            <h3>
                                <a href="{{ route('web.departments.show', $department->id) }}">{{ $department->name }}</a>
                            </h3>
                            <div class="text">{{ $department->description }}</div>
                            <a href="{{ route('web.departments.show', $department->id) }}" class="read-more">
                                {{ __('handle.show.more') }}
                                <span class="arrow fas fa-angle-double-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
