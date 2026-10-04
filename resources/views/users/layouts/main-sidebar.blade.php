<!-- main-sidebar -->
<aside class="app-sidebar sidebar-scroll">

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