@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Hide the image -->
    <style>
        .hide {
            display: none;
        }
    </style>
    <!-- other cruds -->
    <!-- select with ok and cancel -->
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/plugins/sumoselect/sumoselect.css') }}">
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
    @include('cruds.partials.alerts')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @yield('card-body')
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Form-layouts js -->
    <script src="{{ URL::asset('backend/assets/js/form-layouts.js') }}"></script>
    <!-- Display the image -->
    <script>
        var loadFile = function(event) {
            var hiddenDiv = document.querySelector('.hide');
            var output = document.getElementById('output');

            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
            hiddenDiv.classList.remove('hide');
        };
    </script>
    <!-- select with search in the modal -->
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('backend/assets/js/modal.js') }}"></script>
    <!-- select with ok and cancel -->
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('backend/assets/js/advanced-form-elements.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('backend/assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
@endsection
