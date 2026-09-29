@extends('layouts.master2')

@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('backend/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
    <!-- select log in as -->
    <style>
        .login_form {
            display: none;
        }
    </style>

    <!-- Select -->
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    {{ __('auth.login.') }}
@endsection

@section('content')
    <!-- Page -->
    <div class="page">
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                    <div class="row wd-100p mx-auto text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="{{ URL::asset('backend/assets/img/media/login.webp') }}"
                                class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                </div>

                <!-- The content half -->
                <div class="col-md-6 col-lg-6 col-xl-5">
                    <div class="login d-flex align-items-center py-2">
                        <!-- Demo content-->
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="mb-5 d-flex">
                                            <a href="{{ route('web.index') }}">
                                                <img src="{{ URL::asset('frontend/images/HMS.png') }}" alt="logo"
                                                    class="log-favicon ht-40">
                                            </a>
                                            <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">H<span>M</span>S</h1>
                                        </div>

                                        <div class="card-sigin">
                                            <div class="main-logup-header">
                                                <h2>{{ __('general.words.welcome_back') }}</h2>
                                                <h5 class="font-weight-semibold mb-4">
                                                    {{ __('auth.login.please') }}</h5>

                                                <select id="login_as" class="form-control select2-no-search">
                                                    <option disabled selected>{{ __('auth.login.as') }}</option>
                                                    <option value="admin">{{ __('users.admin') }}</option>
                                                    <option value="doctor">{{ __('users.doctor') }}</option>
                                                    <option value="rayEmployee">{{ __('users.rayEmployee') }}
                                                    </option>
                                                    <option value="labEmployee">{{ __('users.labEmployee') }}
                                                    </option>
                                                    <option value="patient">{{ __('users.patient') }}</option>
                                                </select>

                                                <br>
                                                @include('cruds.partials.alerts')
                                                <br>

                                                <div class="login_form" id="admin">
                                                    <h2>
                                                        {{ __('auth.login.as') . ' ' . __('users.admin') }}
                                                    </h2>
                                                    @include('users.admin.partials.login-form')
                                                </div>

                                                <div class="login_form" id="doctor">
                                                    <h2>
                                                        {{ __('auth.login.as') . ' ' . __('users.doctor') }}
                                                    </h2>
                                                    @include('users.doctor.partials.login-form')
                                                </div>

                                                <div class="login_form" id="labEmployee">
                                                    <h2>
                                                        {{ __('auth.login.as') . ' ' . __('users.labEmployee') }}
                                                    </h2>
                                                    @include('users.labEmployee.partials.login-form')
                                                </div>

                                                <div class="login_form" id="rayEmployee">
                                                    <h2>
                                                        {{ __('auth.login.as') . ' ' . __('users.rayEmployee') }}
                                                    </h2>
                                                    @include('users.rayEmployee.partials.login-form')
                                                </div>

                                                <div class="login_form" id="patient">
                                                    <h2>
                                                        {{ __('auth.login.as') . ' ' . __('users.patient') }}
                                                    </h2>
                                                    @include('users.patient.partials.login-form')
                                                </div>

                                                <div class="main-signup-footer mt-5">
                                                    <p>
                                                        {{ __('general.warning.login') }}
                                                        <a href="{{ route('register') }}">
                                                            {{ __('handle.register') }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End -->
                    </div>
                </div><!-- End -->
            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js')
    <!-- select log in as -->
    <script>
        $('#login_as').change(function() {
            var myId = $(this).val();
            $('.login_form').each(function() {
                myId === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>

    <!-- Select -->
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}">
    </script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}">
    </script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('backend/assets/js/form-elements.js') }}"></script>
@endsection
