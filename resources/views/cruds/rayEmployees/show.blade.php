@extends(
    auth()->guard('admin')->check()
        ? 'users.admin.layouts.master'
        : 'users.rayEmployee.layouts.master'
)

@extends('cruds.layouts.show')

@section('title1')
    {{ __('users.rayEmployees') }}
@endsection

@section('title2')
    {{ $rayEmployee->name }}
@endsection

@section('profile-overview')
    <div class="main-img-user profile-user">
        <img alt="" src="{{ asset('backend/images/' . $rayEmployee->image->path) }}">
    </div>
    <div class="d-flex justify-content-between mg-b-20">
        <div>
            <h5 class="main-profile-name">{{ $rayEmployee->name }}</h5>
        </div>
    </div>
    <h6>{{ __('field.bio') }}</h6>
    <div class="main-profile-bio">{{ $rayEmployee->bio }}</div>
    <div class="row d-flex justify-content-between text-center">
        <div>
            <h5>{{ $rayEmployee->rays()->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('cruds.rays') }}</h6>
        </div>
        <div>
            <h5>{{ $rayEmployee->rays()->where('status', 'pending')->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('const.case.pending') }}</h6>
        </div>
        <div>
            <h5>{{ $rayEmployee->rays()->where('status', 'completed')->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('statistics.completed.') }}</h6>
        </div>
    </div>
@endsection

@section('profile-details')
    <div class="tabs-menu ">
        <!-- Tabs -->
        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs">
                        <i class="las la-user-circle tx-16 mr-1"></i>
                    </span>
                    <span class="hidden-xs">{{ __('field.about_me') }}</span>
                </a>
            </li>
            <li class="">
                <a href="#profile" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs">
                        <i class="las la-images tx-15 mr-1"></i>
                    </span>
                    <span class="hidden-xs">{{ __('handle.edit') }}</span>
                </a>
            </li>
            <li class="">
                <a href="#settings" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs">
                        <i class="las la-cog tx-16 mr-1"></i>
                    </span>
                    <span class="hidden-xs">{{ __('auth.') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
        <div class="tab-pane active" id="home">
            @include('cruds.rayEmployees.partials.show-table')
        </div>

        <div class="tab-pane" id="profile">
            @include('cruds.rayEmployees.partials.edit-form')
        </div>

        <div class="tab-pane" id="settings">
            @include('cruds.rayEmployees.partials.password-form')

            <hr>

            @include('cruds.rayEmployees.partials.delete-account-card')
        </div>
    </div>
@endsection
