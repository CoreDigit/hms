<section class="price-section">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>{{ __('cruds.services.multi') }}</h2>
            <div class="separator"></div>
        </div>

        @php
            $icons = ['icon flaticon-doctor-stethoscope', 'icon flaticon-operating-room', 'icon flaticon-pharmacy'];
        @endphp

        <div class="row clearfix">
            <!-- Price Block -->
            @foreach ($multiServices as $i => $multiService)
                <div class="price-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box clearfix wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="{{ $icons[$i] }}"></div>
                            <div class="title">{{ $multiService->name }}</div>
                            <div class="price"><sub>$</sub>{{ $multiService->service->price }}</div>
                        </div>
                        <div class="middle-content">
                            <ul>
                                @foreach ($multiService->singleServices as $singleService)
                                    <li>{{ $singleService->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="#" class="appointment">get appointment</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
