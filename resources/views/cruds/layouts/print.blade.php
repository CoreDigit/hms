@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection

@section('title')
    @yield('title1') | {{ __('handle.print') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@yield('title1')</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('handle.print') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row row-sm" id="print">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">@yield('invoice-title')</h1>
                            <div class="billed-from">@yield('billed-from')</div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md">@yield('billed-to')</div>
                            <div class="col-md">@yield('invoice-info')</div>
                        </div>
                        <div class="table-responsive mg-t-40">@yield('invoice-table')</div>
                        <hr class="">
                        <a href="#" id="print_Button" onclick="printDiv()"
                            class="btn btn-danger float-right mt-3 ml-2">
                            <i class="mdi mdi-printer mr-1"></i>{{ __('handle.print') }}
                        </a>
                    </div>
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
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('backend/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- printing -->
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection