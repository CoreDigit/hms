@extends('users.admin.layouts.master')

@extends('cruds.layouts.show')

@section('title1')
    {{ __('users.admins') }}
@endsection

@section('title2')
    {{ $admin->name }}
@endsection

@section('profile-overview')
    <div class="main-img-user profile-user">
        <img alt="" src="{{ asset('backend/images/' . $admin->image->path) }}">
    </div>
    <div class="d-flex justify-content-between mg-b-20">
        <div>
            <h5 class="main-profile-name">{{ $admin->name }}</h5>
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
            <li class="">
                <a href="#account" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="las la-comment-dollar"></i></span>
                    <span class="hidden-xs">{{ __('cruds.account.') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
        <div class="tab-pane active" id="home">
            @include('cruds.admins.partials.show-table')
        </div>

        <div class="tab-pane" id="profile">
            @include('cruds.admins.partials.edit-form')
        </div>

        <div class="tab-pane" id="settings">
            @include('cruds.admins.partials.password-form')

            <hr>

            @include('cruds.admins.partials.delete-account-card')
        </div>

        <div class="tab-pane" id="account">
            @include('cruds.fund-accounts.partials.fund-account-card')
        </div>
    </div>
@endsection
