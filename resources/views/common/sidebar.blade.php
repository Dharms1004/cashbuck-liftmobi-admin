<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            {{-- <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
            <img src="{!! asset('dist/img/user2-160x160.jpg') !!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="{{ route('home') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard

                    </p>
                </a>

            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Offers
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('offerList') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Offers List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('createOffer') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Offer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('convertOffer-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Converted Offers</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-rupee-sign"></i>
                    <p>
                        Transactions
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('withdraw-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="{{ route('createOffer') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Offers</p>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User List</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="{{ route('createOffer') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Offers</p>
                        </a>
                    </li> -->
                </ul>
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gamepad"></i>
                    <p>
                        Games
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('game-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Games List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('createGame') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Game</p>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gamepad"></i>
                    <p>
                        Video Listing
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('video-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Video List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('createVideo') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Video</p>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gamepad"></i>
                    <p>
                        Mini Banner
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('banner-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Banner List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('createBanner') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('createPopup') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Popup</p>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-award"></i>
                    <p>
                        Contest
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Contest List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manage-question') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Questions</p>
                        </a>
                    </li>
                </ul>
            </li> -->


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Admin Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin Register</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sendNotification') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Push Notification</p>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
