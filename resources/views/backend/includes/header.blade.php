<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('backend.dashboard') }}">
        <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" height="40" alt="Logo">
        <img class="navbar-brand-minimized" src="{{ asset('img/favicon-cube.png') }}" width="30" height="30" alt="Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('frontend.index') }}" target="_blank"> {{ app_name() }} </a>
        </li>
    </ul>
    <?php
    $notifications = optional(auth()->user())->unreadNotifications;
    $notifications_count = optional($notifications)->count();
    $notifications_latest = optional($notifications)->take(5);
    ?>
    <ul class="nav navbar-nav ml-auto">

        

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset(auth()->user()->avatar) }}" class="img-avatar" alt="{{ auth()->user()->name }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="fas fa-at"></i> {{ Auth::user()->email }}
                </a>
                
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-lock"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <!-- <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button> -->
</header>
