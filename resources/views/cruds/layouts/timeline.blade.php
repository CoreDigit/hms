@section('css')
    <!---Internal  Owl Carousel css-->
    <link href="{{ URL::asset('backend/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!--- Internal Timeline css-->
    <link href="{{ URL::asset('backend/assets/plugins/timeline/css/timeline.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    @yield('title1') | @yield('title2')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@yield('title1')</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ @yield('title2')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <h6 class="card-title mb-0">@yield('title3')</h6>
                </div>
                <div class="card-body">@yield('timeline')</div>
            </div>
        </div>
    </div>
    <!-- End Row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
@endsection
