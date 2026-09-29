@section('css')
    <!-- Hide the image -->
    <style>
        .hide {
            display: none;
        }
    </style>
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
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            @yield('profile-overview')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            @include('cruds.partials.alerts')
            <div class="card">
                <div class="card-body">
                    @yield('profile-details')
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
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
@endsection
