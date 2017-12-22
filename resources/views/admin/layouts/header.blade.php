<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="#" class="logo"><i class="mdi mdi-radar"></i> <span>Minton</span></a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                   href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i style="margin-top: 6px;margin-right: 3px" class="mdi mdi-bell noti-icon"></i>
                    <span class="badge badge-pink noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg"
                     aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16"><span class="badge badge-danger float-right">5</span>Notification</h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="mdi mdi-comment-account"></i></div>
                        <p class="notify-details">Robert S. Taylor commented on Admin
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="mdi mdi-account"></i></div>
                        <p class="notify-details">New user registered.
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="mdi mdi-airplane"></i></div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b>
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>

                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                   href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}" alt="user"
                         class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-star-variant"></i> <span>设置</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout"></i> <span>退出</span>
                    </a>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>