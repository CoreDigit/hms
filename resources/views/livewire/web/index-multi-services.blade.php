<div class="row clearfix">
    <!--Content Side-->
    <div class="content-side col-lg-9 col-md-12 col-sm-12">
        <div class="row clearfix">
            <!--Shop Item-->
            @foreach ($multiServices as $multiService)
                <div class="product-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <img src="{{ asset('frontend/assets/images/resource/products/1.jpg') }}" alt="" />
                            <ul class="options clearfix">
                                <li>
                                    <a href="{{ route('web.multi.services.show', $multiService->id) }}">
                                        {{ __('handle.show.more') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('web.multi.services.show', $multiService->id) }}">
                                        <span class="icon flaticon-shopping-cart"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="lower-box">
                            <div class="content">
                                <h3>
                                    <a href="{{ route('web.multi.services.show', $multiService->id) }}">
                                        {{ $multiService->name }}
                                    </a>
                                </h3>
                                <div class="price">$ {{ $multiService->service->price }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination justify-content-center">
            {{ $multiServices->links() }}
        </div>
    </div>


    <!--Sidebar Side-->
    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
        <aside class="sidebar default-sidebar">
            <!-- Search -->
            <div class="sidebar-widget search-box">
                <div class="sidebar-title">
                    <h3>{{ __('handle.search.service') }}</h3>
                </div>
                <div class="form-group">
                    <input type="search" wire:model.live='search' placeholder="{{ __('handle.search.') }} ..."
                        required>
                    <button type="submit">
                        <span class="icon fa fa-search"></span>
                    </button>
                </div>
            </div>

            <!--Blog Category Widget-->
            <div class="sidebar-widget sidebar-blog-category">
                <div class="sidebar-title">
                    <h3>{{ __('general.words.statistics') }}</h3>
                </div>
                <ul class="archive-list">
                    <li>
                        <a href="" class="clearfix">
                            <span class="pull-left">
                                {{ __('statistics.all.services.multi') }}
                            </span>
                            <span class="pull-right">({{ $count['multiServices'] }})</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</div>
