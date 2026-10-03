<!-- main-sidebar -->
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="text-decoration: none;">
            <span style="font-size: 22px; font-weight: bold; color: #1a73e8; letter-spacing: 1px;">CoreDigit</span>
        </a>
        <a class="desktop-logo logo-dark active d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="text-decoration: none;">
            <span style="font-size: 22px; font-weight: bold; color: #ffffff; letter-spacing: 1px;">CoreDigit</span>
        </a>
        <a class="logo-icon mobile-logo icon-light active d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="text-decoration: none;">
            <span style="font-size: 18px; font-weight: bold; color: #1a73e8;">CD</span>
        </a>
        <a class="logo-icon mobile-logo icon-dark active d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="text-decoration: none;">
            <span style="font-size: 18px; font-weight: bold; color: #ffffff;">CD</span>
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