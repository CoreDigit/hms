<section class="faq-form-section">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>{{ __('general.faq.ask') }}</h2>
            <div class="separator"></div>
        </div>

        <!-- Faq Form -->
        <div class="faq-form">
            <!--Faq Form-->
            <form method="post" action="{{ route('web.about.ask') }}">
                @csrf

                <div class="row clearfix">
                    @include('frontend.partials.alerts')

                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <input type="text" name="name" placeholder="{{ __('field.name') }}" required>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <input type="email" name="email" placeholder="{{ __('field.email') }}" required>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <input type="text" name="phone" placeholder="{{ __('field.phone') }}" required>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <input type="text" name="department" placeholder="{{ __('cruds.department') }}" required>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <textarea name="message" placeholder="{{ __('general.words.your_question') }}"></textarea>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
                        <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                            <span class="txt">{{ __('general.faq.ask') }}</span>
                        </button>
                    </div>
                </div>
            </form>
            <!--End Faq Form -->
        </div>
    </div>
</section>
