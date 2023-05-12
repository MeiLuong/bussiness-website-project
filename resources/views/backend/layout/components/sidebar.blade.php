<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex" style="background-color: #fff">
        <a href="./" class="logo">
            <img src="assets/images/website/logo.png" alt="">
        </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="admin/dashboard">
                Dashboard
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                Sales
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('orders') }}"><span class="nav-icon"></span> Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('news') }}"><span class="nav-icon"></span> New Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('invoices') }}"><span class="nav-icon"></span> Processing</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shipments') }}"><span class="nav-icon"></span> Completed</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cancels') }}"><span class="nav-icon"></span> Cancel</a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                Catalog
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('products') }}"><span class="nav-icon"></span> Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('category') }}"><span class="nav-icon"></span> Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('brands') }}"><span class="nav-icon"></span> Brands</a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                Blogs
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}"><span class="nav-icon"></span> All Blogs</a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                Users
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="admin/customers"><span class="nav-icon"></span> All Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="admin/adminer"><span class="nav-icon"></span> Admin Account</a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                Stores
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{route('banners')}}"><span class="nav-icon"></span> Manage Slider</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('index')}}"><span class="nav-icon"></span> All Pages</a></li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
