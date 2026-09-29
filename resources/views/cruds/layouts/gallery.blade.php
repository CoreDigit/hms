@section('css')
    <!-- Internal Gallery css -->
    <link href="{{ URL::asset('backend/assets/plugins/gallery/gallery.css') }}" rel="stylesheet">
@endsection

@section('title')
    @yield('title1') | {{ __('general.words.gallery') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@yield('title1')</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('general.words.gallery') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- Gallery -->
    <div class="demo-gallery">
        <ul id="lightgallery" class="list-unstyled row row-sm">@yield('gallery')</ul>
        <!-- /Gallery -->

        <!-- Pagination -->
        <div class="row mb-5">@yield('pagination')</div>
        <!-- Pagination -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection


@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Gallery js -->
    <script src="{{ URL::asset('backend/assets/plugins/gallery/lightgallery-all.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/gallery/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/gallery.js') }}"></script>
@endsection
