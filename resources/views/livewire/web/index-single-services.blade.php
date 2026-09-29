<div class="row clearfix">
    <!--Content Side-->
    <div class="content-side col-lg-9 col-md-12 col-sm-12">
        <div class="row clearfix">
            <!--Shop Item-->
            @foreach ($singleServices as $singleService)
                <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $singleService->name }}</h4>
                            <p class="card-text">{{ $singleService->description }}</p>
                            <div class="text-success fs-5">${{ $singleService->service->price }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination justify-content-center">
            {{ $singleServices->links() }}
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
                                {{ __('statistics.all.services.single') }}
                            </span>
                            <span class="pull-right">({{ $count['singleServices'] }})</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</div>
