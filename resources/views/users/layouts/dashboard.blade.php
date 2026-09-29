@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('backend/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('backend/assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- row -->
    @yield('statistics')
    <!-- row closed -->
    <!-- /row -->
    </div>
    <!-- /Container -->
    </div>
    <!-- /main-content -->
@endsection

@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('backend/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('backend/assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('backend/assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('backend/assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('backend/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('backend/assets/js/index-dark.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
