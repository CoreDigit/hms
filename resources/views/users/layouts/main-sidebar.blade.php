<!-- main-sidebar -->
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/') }}">
            <img src="{{ URL::asset('frontend/images/HMS.png') }}" class="main-logo" alt="logo">
        </a>
        <a class="desktop-logo logo-dark active" href="{{ url('/') }}">
            <img src="{{ URL::asset('frontend/images/HMS.png') }}" class="main-logo dark-theme" alt="logo">
        </a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}">
            <img src="{{ URL::asset('frontend/images/HMS.png') }}" class="logo-icon" alt="logo">
        </a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}">
            <img src="{{ URL::asset('frontend/images/HMS.png') }}" class="logo-icon dark-theme" alt="logo">
        </a>
    </div>

    @php
        $user = auth()->user();
    @endphp
    
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('backend/images/' . $user->image->path) }}">
                    <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ $user->name }}</h4>
                    <span class="mb-0 text-muted">{{ $user->email }}</span>
                </div>
            </div>
        </div>

        <ul class="side-menu">@yield('side-menu')</ul>
    </div>
</aside>
<!-- main-sidebar -->