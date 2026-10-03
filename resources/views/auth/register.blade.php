@extends('layouts.master2')

@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('backend/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
    <style>
        .register_form {
            display: none;
        }
    </style>
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    {{ __('auth.register.') }}
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
                            <img src="{{ URL::asset('backend/assets/img/media/register.jpg') }}"
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
                                            <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28 font-weight-bold text-primary">CoreDigit</h1>
                                        </div>

                                        <div class="main-signup-header">
                                            <h2 class="text-primary">
                                                {{ __('general.words.get_started') }}
                                            </h2>
                                            <h5 class="font-weight-normal mb-4">
                                                {{ __('general.note.register') }}
                                            </h5>

                                            <select id="register_as" class="form-control select2-no-search">
                                                <option disabled selected>{{ __('auth.register.as') }}</option>
                                                <option value="admin">{{ __('users.admin') }}</option>
                                                <option value="receptionist">Receptionist / Front Desk</option>
                                                <option value="doctor">{{ __('users.doctor') }}</option>
                                                <option value="nurse">Nurse / Clinical Staff</option>
                                                <option value="accountant">Accountant / Billing</option>
                                                <option value="pharmacist">Pharmacist</option>
                                                <option value="rayEmployee">{{ __('users.rayEmployee') }}</option>
                                                <option value="labEmployee">{{ __('users.labEmployee') }}</option>
                                                <option value="patient">{{ __('users.patient') }}</option>
                                            </select>

                                            <br>
                                            @include('cruds.partials.alerts')
                                            <br>

                                            <div class="register_form" id="admin">
                                                <h2>{{ __('auth.register.as') . ' ' . __('users.admin') }}</h2>
                                                @include('users.admin.partials.register-form')
                                            </div>

                                            <div class="register_form" id="receptionist">
                                                <h2>Register as Receptionist</h2>
                                                @include('users.receptionist.partials.register-form')
                                            </div>

                                            <div class="register_form" id="doctor">
                                                <h2>{{ __('auth.register.as') . ' ' . __('users.doctor') }}</h2>
                                                @include('users.doctor.partials.register-form')
                                            </div>

                                            <div class="register_form" id="nurse">
                                                <h2>Register as Nurse</h2>
                                                @include('users.nurse.partials.register-form')
                                            </div>

                                            <div class="register_form" id="accountant">
                                                <h2>Register as Accountant</h2>
                                                @include('users.accountant.partials.register-form')
                                            </div>

                                            <div class="register_form" id="pharmacist">
                                                <h2>Register as Pharmacist</h2>
                                                @include('users.pharmacist.partials.register-form')
                                            </div>

                                            <div class="register_form" id="labEmployee">
                                                <h2>{{ __('auth.register.as') . ' ' . __('users.labEmployee') }}</h2>
                                                @include('users.labEmployee.partials.register-form')
                                            </div>

                                            <div class="register_form" id="rayEmployee">
                                                <h2>{{ __('auth.register.as') . ' ' . __('users.rayEmployee') }}</h2>
                                                @include('users.rayEmployee.partials.register-form')
                                            </div>

                                            <div class="register_form" id="patient">
                                                <h2>{{ __('auth.register.as') . ' ' . __('users.patient') }}</h2>
                                                @include('users.patient.partials.register-form')
                                            </div>

                                            <div class="main-signup-footer mt-5">
                                                <p>
                                                    {{ __('general.warning.register') }}
                                                    <a href="{{ route('login') }}">
                                                        {{ __('auth.login.') }}
                                                    </a>
                                                </p>
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
    <script>
        $('#register_as').change(function() {
            var myId = $(this).val();
            $('.register_form').each(function() {
                myId === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/form-elements.js') }}"></script>
@endsection
