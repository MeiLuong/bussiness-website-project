<header class="header header-sticky mb-4">
    <div class="container-fluid">

        <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bell"></use>
                    </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-list-rich"></use>
                    </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-envelope-open"></use>
                    </svg></a></li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <span class="label admin-name">{{ \Illuminate\Support\Facades\Auth::user()->name }} </span>
                        <span class="icon fcp-user1"></span>
                        <span class="icon fcp-arrow_drop_down"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">

                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Settings</div>
                    </div>
                    <a class="dropdown-item" href="{{ route('edit_adminer', \Illuminate\Support\Facades\Auth::user()->id) }}">
                        Profile
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('change_passwordAD') }}">
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('logoutAdmin') }}">
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>Dashboard</span>
                </li>
                <li class="breadcrumb-item active"><span>@yield('title')</span></li>
            </ol>
        </nav>
    </div>
</header>
