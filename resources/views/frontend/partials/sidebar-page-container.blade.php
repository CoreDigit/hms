<div class="sidebar-page-container style-two">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Sidebar Side-->
            <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar">
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                    </div>
                    <!-- Help widgets -->
                    <div class="sidebar-widget need-help">
                        <h3>{{ __('general.contact.help') }}</h3>
                        <p>{{ __('general.contact.note') }}</p>
                        <ul>
                            <li>
                                <i class="fa fa-tty"></i>
                                 +20 1026264486
                            </li>
                            <li>
                                <i class="far fa-envelope"></i>
                                zyadgamal450@gmail.com
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>

            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="department-detail">
                    <div class="image-box">
                        <figure>
                            <img src="{{ asset('backend/images/' . $department->image->path) }}" alt="">
                        </figure>
                    </div>

                    <div class="lower-content">
                        <h2>{{ $department->name }}</h2>
                        <p>{{ $department->description }}</p>
                    </div>
                </div>
                <!-- Service Detail -->
            </div>
        </div>
    </div>
</div>
