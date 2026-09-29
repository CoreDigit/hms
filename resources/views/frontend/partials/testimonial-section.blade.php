<section class="testimonial-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>
                {{ __('general.words.testimonial_section.0') }}
            </h2>
            <div class="text-muted mb-3">
                {{ __('general.words.testimonial_section.1') }}
            </div>
            <div class="separator"></div>
        </div>

        <div class="testimonial-outer"
            style="background-image: url({{ asset('frontend/assets/images/background/pattern-4.png') }})">
            <!--Client Testimonial Carousel-->
            <div class="client-testimonial-carousel owl-carousel owl-theme">
                <!--Testimonial Block -->
                @foreach ($patients as $patient)
                    <div class="testimonial-block">
                        <div class="inner-box">
                            <div class="quote-icon flaticon-quote"></div>
                            <div class="text">
                                {{ $patient->address }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!--Product Thumbs Carousel-->
            <div class="client-thumb-outer">
                <div class="client-thumbs-carousel owl-carousel owl-theme">
                    @foreach ($patients as $patient)
                        <div class="thumb-item">
                            <figure class="thumb-box">
                                <img src="{{ asset('backend/images/' . $patient->image->path) }}" alt="">
                            </figure>
                            <div class="author-info">
                                <div class="author-name">
                                    {{ $patient->name }}
                                </div>
                                <div class="designation">
                                    {{ $patient->email }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
