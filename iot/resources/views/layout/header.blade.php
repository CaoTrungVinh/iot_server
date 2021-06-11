<div class="row header shadow-sm">

    <!--Logo-->
    <div class="col-sm-3 pl-0 text-center header-logo">
        <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
            <h3 class="logo"><a href="#" class="text-secondary logo"><i class="fa fa-rocket"></i> Sleek<span class="small">admin</span></a></h3>
        </div>
    </div>
    <!--Logo-->

    <!--Header Menu-->
    <div class="col-sm-9 header-menu pt-2 pb-0">
        <div class="row">

            <!--Menu Icons-->
            <div class="col-sm-4 col-8 pl-0">
                <!--Toggle sidebar-->
                <span class="menu-icon" onclick="toggle_sidebar()">
                            <span id="sidebar-toggle-btn"></span>
                        </span>
                <!--Toggle sidebar-->
                <!--Notification icon-->
                <div class="menu-icon">
                    <a class="" href="#" onclick="toggle_dropdown(this); return false" role="button" class="dropdown-toggle">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger">5</span>
                    </a>
                    <div class="dropdown dropdown-left bg-white shadow border">
                        <a class="dropdown-item" href="#"><strong>Notifications</strong></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="align-self-center mr-3 rounded-circle notify-icon bg-primary">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0"><strong>Meeting</strong></h6>
                                    <p>You have a meeting by 8:00</p>
                                    <small class="text-success">09:23am</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="align-self-center mr-3 rounded-circle notify-icon bg-secondary">
                                    <i class="fa fa-link"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0"><strong>Events</strong></h6>
                                    <p>Launching new programme</p>
                                    <small class="text-success">09:23am</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0"><strong>Personnel</strong></h6>
                                    <p>New employee arrival</p>
                                    <small class="text-success">09:23am</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center link-all" href="#">See all notifications ></a>
                    </div>
                </div>
                <!--Notication icon-->

                <!--Inbox icon-->
                <span class="menu-icon inbox">
                            <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="badge badge-danger">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mt-10 animated zoomInDown" aria-labelledby="dropdownMenuLink3">
                                <a class="dropdown-item" href="#"><strong>Unread messages</strong></a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <img class="align-self-center mr-3 rounded-circle" src="assets/img/profile.jpg" width="50px" height="50px" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6 class="mt-0"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class="text-success">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <img class="align-self-center mr-3 rounded-circle" src="assets/img/profile.jpg" width="50px" height="50px" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6 class="mt-0"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class="text-success">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <img class="align-self-center mr-3 rounded-circle" src="assets/img/profile.jpg" width="50px" height="50px" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6 class="mt-0"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class="text-success">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center link-all" href="#">View all messages</a>
                            </div>
                        </span>
                <!--Inbox icon-->
                <span class="menu-icon">
                            <i class="fa fa-th-large"></i>
                        </span>
            </div>
            <!--Menu Icons-->

            <!--Search box and avatar-->
            <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                <div class="search-rounded mr-3">
                    <input type="text" class="form-control search-box" placeholder="Enter keywords.." />
                </div>
                <div class="mr-4">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="assets/img/profile.jpg" alt="Adam" class="rounded-circle" width="40px" height="40px">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fa fa-user pr-2"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-th-list pr-2"></i> Tasks</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-book pr-2"></i> Projects</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('getAdLogout')}}"><i class="fa fa-power-off pr-2"></i> Logout</a>
                    </div>
                </div>
            </div>
            <!--Search box and avatar-->
        </div>
    </div>
    <!--Header Menu-->
</div>
