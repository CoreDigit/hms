<section class="department-section">
    <div class="auto-container">

        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>{{ __('cruds.departments') }}</h2>
            <div class="separator"></div>
        </div>

        <div class="services-carousel owl-carousel owl-theme">
            @foreach ($departments as $department)
                <div class="department-block">
                    <div class="inner-box">
                        <div class="upper-box">
                            <div class="icon flaticon-kidneys"></div>
                            <h3><a href="{{ route('web.departments.show', $department->id) }}">{{ $department->name }}</a></h3>
                        </div>
                        <div class="text">{{ $department->description }}</div>
                        <div class="read-outer">
                            <a href="{{ route('web.departments.show', $department->id) }}" class="read-more">
                                {{ __('handle.read.more') }}
                                <span class="icon fas fa-angle-double-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
