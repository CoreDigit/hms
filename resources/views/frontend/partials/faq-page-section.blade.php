<section class="faq-page-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>
                {{ __('general.faq._') }}
                <br>
                {{ __('general.faq.note') }}
            </h2>
            <div class="separator"></div>
        </div>

        <!-- Faq Info Tabs-->
        <div class="faq-info-tabs">
            <!-- Faq Tabs -->
            <div class="faq-tabs tabs-box">
                <!--Tab Btns-->
                <ul class="tab-btns tab-buttons clearfix">
                    <li data-tab="#prod-general" class="tab-btn active-btn">{{ __('general.words.general') }}</li>
                    <li data-tab="#prod-urgent" class="tab-btn">{{ __('general.words.urgent') }}</li>
                </ul>

                <!--Tabs Container-->
                <div class="tabs-content">
                    <!--Tab / Active Tab-->
                    <div class="tab active-tab" id="prod-general">
                        <div class="content">
                            <div class="row clearfix">
                                <div class="column col-lg-6 col-md-12 col-sm-12">
                                    <!--Accordian Box-->
                                    <ul class="accordion-box">
                                        <!--Block-->
                                        @foreach ($general_faqs[0] as $faq)
                                            <li class="accordion block">
                                                <div class="acc-btn">
                                                    <div class="icon-outer">
                                                        <span class="icon icon-plus flaticon-add"></span>
                                                        <span class="icon icon-minus fas fa-minus"></span>
                                                    </div>
                                                    {{ $faq->question }}
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content">
                                                        <div class="text">
                                                            {{ $faq->answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="column col-lg-6 col-md-12 col-sm-12">
                                    <!--Accordian Box-->
                                    <ul class="accordion-box">
                                        <!--Block-->
                                        @foreach ($general_faqs[1] as $faq)
                                            <li class="accordion block">
                                                <div class="acc-btn">
                                                    <div class="icon-outer">
                                                        <span class="icon icon-plus flaticon-add"></span>
                                                        <span class="icon icon-minus fas fa-minus"></span>
                                                    </div>
                                                    {{ $faq->question }}
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content">
                                                        <div class="text">
                                                            {{ $faq->answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Tab-->
                    <div class="tab" id="prod-urgent">
                        <div class="content">
                            <div class="row clearfix">
                                <div class="column col-lg-6 col-md-12 col-sm-12">
                                    <!--Accordian Box-->
                                    <ul class="accordion-box">
                                        <!--Block-->
                                        @foreach ($urgent_faqs[0] as $faq)
                                            <li class="accordion block">
                                                <div class="acc-btn">
                                                    <div class="icon-outer">
                                                        <span class="icon icon-plus flaticon-add"></span>
                                                        <span class="icon icon-minus fas fa-minus"></span>
                                                    </div>
                                                    {{ $faq->question }}
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content">
                                                        <div class="text">
                                                            {{ $faq->answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="column col-lg-6 col-md-12 col-sm-12">
                                    <!--Accordian Box-->
                                    <ul class="accordion-box">
                                        <!--Block-->
                                        @foreach ($urgent_faqs[1] as $faq)
                                            <li class="accordion block">
                                                <div class="acc-btn">
                                                    <div class="icon-outer">
                                                        <span class="icon icon-plus flaticon-add"></span>
                                                        <span class="icon icon-minus fas fa-minus"></span>
                                                    </div>
                                                    {{ $faq->question }}
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content">
                                                        <div class="text">
                                                            {{ $faq->answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
