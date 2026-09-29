@extends('users.layouts.main-header')

@section('main-header-message')
    <a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-mail">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
            </path>
            <polyline points="22,6 12,13 2,6"></polyline>
        </svg><span class=" pulse-danger"></span></a>
    <div class="dropdown-menu">
        <div class="menu-header-content bg-primary text-left">
            <div class="d-flex">
                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
                <span class="badge badge-pill badge-warning ml-auto my-auto float-right">Mark All
                    Read</span>
            </div>
            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread
                messages</p>
        </div>
        <div class="main-message-list chat-scroll">
            <a href="#" class="p-3 d-flex border-bottom">
                <div class="  drop-img  cover-image  " data-image-src="{{ URL::asset('backend/assets/img/faces/3.jpg') }}">
                    <span class="avatar-status bg-teal"></span>
                </div>
                <div class="wd-90p">
                    <div class="d-flex">
                        <h5 class="mb-1 name">Petey Cruiser</h5>
                    </div>
                    <p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>
                    <p class="time mb-0 text-left float-left ml-2 mt-2">Mar 15 3:55 PM</p>
                </div>
            </a>
            <a href="#" class="p-3 d-flex border-bottom">
                <div class="drop-img cover-image" data-image-src="{{ URL::asset('backend/assets/img/faces/2.jpg') }}">
                    <span class="avatar-status bg-teal"></span>
                </div>
                <div class="wd-90p">
                    <div class="d-flex">
                        <h5 class="mb-1 name">Jimmy Changa</h5>
                    </div>
                    <p class="mb-0 desc">All set ! Now, time to get to you now......</p>
                    <p class="time mb-0 text-left float-left ml-2 mt-2">Mar 06 01:12 AM</p>
                </div>
            </a>
            <a href="#" class="p-3 d-flex border-bottom">
                <div class="drop-img cover-image" data-image-src="{{ URL::asset('backend/assets/img/faces/9.jpg') }}">
                    <span class="avatar-status bg-teal"></span>
                </div>
                <div class="wd-90p">
                    <div class="d-flex">
                        <h5 class="mb-1 name">Graham Cracker</h5>
                    </div>
                    <p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
                    <p class="time mb-0 text-left float-left ml-2 mt-2">Feb 25 10:35 AM</p>
                </div>
            </a>
            <a href="#" class="p-3 d-flex border-bottom">
                <div class="drop-img cover-image" data-image-src="{{ URL::asset('backend/assets/img/faces/12.jpg') }}">
                    <span class="avatar-status bg-teal"></span>
                </div>
                <div class="wd-90p">
                    <div class="d-flex">
                        <h5 class="mb-1 name">Donatella Nobatti</h5>
                    </div>
                    <p class="mb-0 desc">Here are some products ...</p>
                    <p class="time mb-0 text-left float-left ml-2 mt-2">Feb 12 05:12 PM</p>
                </div>
            </a>
            <a href="#" class="p-3 d-flex border-bottom">
                <div class="drop-img cover-image" data-image-src="{{ URL::asset('backend/assets/img/faces/5.jpg') }}">
                    <span class="avatar-status bg-teal"></span>
                </div>
                <div class="wd-90p">
                    <div class="d-flex">
                        <h5 class="mb-1 name">Anne Fibbiyon</h5>
                    </div>
                    <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                    <p class="time mb-0 text-left float-left ml-2 mt-2">Jan 29 03:16 PM</p>
                </div>
            </a>
        </div>
        <div class="text-center dropdown-footer">
            <a href="text-center">VIEW ALL</a>
        </div>
    </div>
@endsection

@section('main-header-notification')
    <a class="new nav-link" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg><span class=" pulse"></span></a>
    <div class="dropdown-menu">
        <div class="menu-header-content bg-primary text-left">
            <div class="d-flex">
                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications
                </h6>
                <span class="badge badge-pill badge-warning ml-auto my-auto float-right">Mark All
                    Read</span>
            </div>
            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread
                Notifications</p>
        </div>
        <div class="main-notification-list Notification-scroll">
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-pink">
                    <i class="la la-file-alt text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">New files available</h5>
                    <div class="notification-subtext">10 hour ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
            <a class="d-flex p-3" href="#">
                <div class="notifyimg bg-purple">
                    <i class="la la-gem text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">Updates Available</h5>
                    <div class="notification-subtext">2 days ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-success">
                    <i class="la la-shopping-basket text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">New Order Received</h5>
                    <div class="notification-subtext">1 hour ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-warning">
                    <i class="la la-envelope-open text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">New review received</h5>
                    <div class="notification-subtext">1 day ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-danger">
                    <i class="la la-user-check text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">22 verified registrations</h5>
                    <div class="notification-subtext">2 hour ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-primary">
                    <i class="la la-check-circle text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">Project has been approved</h5>
                    <div class="notification-subtext">4 hour ago</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-right text-right text-muted"></i>
                </div>
            </a>
        </div>
        <div class="dropdown-footer">
            <a href="">VIEW ALL</a>
        </div>
    </div>
@endsection

@section('main-profile-menu')
    <a class="profile-user d-flex" href="">
        <img alt="" src="{{ asset('backend/images/' . $doctor->image->path) }}">
    </a>
    <div class="dropdown-menu">
        <div class="main-header-profile bg-primary p-3">
            <div class="d-flex wd-100p">
                <div class="main-img-user">
                    <img alt="" src="{{ asset('backend/images/' . $doctor->image->path) }}" class="">
                </div>
                <div class="ml-3 my-auto">
                    <h6>{{ $doctor->name }}</h6>
                    <span>{{ $doctor->email }}</span>
                </div>
            </div>
        </div>

        <a class="dropdown-item" href="{{ route('doctor.show') }}">
            <i class="bx bx-user-circle"></i>{{ __('general.words.profile') }}
        </a>
        <form action="{{ route('doctor.logout') }}" method="POST">
            @csrf
        
            <button class="dropdown-item">
                <i class="bx bx-log-out"></i>{{ __('auth.logout') }}
            </button>
        </form>
    </div>
@endsection
