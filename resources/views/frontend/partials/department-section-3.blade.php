<section class="department-section-three">
    <div class="image-layer" style="background-image:url({{ asset('frontend/assets/images/background/6.jpg') }})"></div>
    <div class="auto-container">
        <!-- Department Tabs-->
        <div class="department-tabs tabs-box">
            <div class="row clearfix">
                <!--Column-->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <!-- Sec Title -->
                    <div class="sec-title light">
                        <h2>{{ __('general.words.health_department') }}</h2>
                        <div class="separator"></div>
                    </div>
                    <!--Tab Btns-->
                    <ul class="tab-btns tab-buttons clearfix">
                        @foreach ($departments as $department)
                            <li data-tab="#department-{{ $department->id }}"
                                class="tab-btn {{ $loop->first ? 'active-btn' : '' }}">{{ $department->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <!--Column-->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <!--Tabs Container-->
                    <div class="tabs-content">
                        <!-- Tab -->
                        @foreach ($departments as $department)
                            <div class="tab {{ $loop->first ? 'active-tab' : '' }}" id="department-{{ $department->id }}">
                                <div class="content">
                                    <h2>{{ $department->name }}</h2>
                                    <div class="text">
                                        <p>{{ $department->description }}</p>
                                    </div>
                                    <a href="{{ route('web.departments.show', $department->id) }}" class="theme-btn btn-style-two">
                                        <span class="txt">{{ __('handle.show.more') }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
