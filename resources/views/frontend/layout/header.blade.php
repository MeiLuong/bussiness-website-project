<header id="header" class="header-scrolled text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="assets/images/website/logo.png" class="logo">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon fcp-th-menu"></span>
                <span class="label hidden"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">

                <div class="offcanvas-header px-4 pb-0">
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link me-4 {{ (request()->segment(1) == '') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4 {{ (request()->segment(1) == 'home') ? 'active' : '' }}" href="/home">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4 {{ (request()->segment(1) == 'blogs') ? 'active' : '' }}" href="/blogs">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4 {{ (request()->segment(1) == '1') ? 'active' : '' }}" href="/page/6">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4 {{ (request()->segment(1) == 'blogs') ? 'active' : '' }}" href="/services">Contact</a>
                        </li>
{{--                        <li class="nav-item nav-hover">--}}
{{--                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>--}}
{{--                            <ul class="hover-menu">--}}
{{--                                <li>--}}
{{--                                    <a href="/about" class="dropdown-item {{ (request()->segment(1) == 'about') ? 'active' : '' }}">About</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="/blogs" class="dropdown-item {{ (request()->segment(1) == 'blogs') ? 'active' : '' }}">Blogs</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="/contact" class="dropdown-item {{ (request()->segment(1) == 'contact') ? 'active' : '' }}">Contact</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="search-item pe-3">
                                        <a href="#" class="nav-link search-button">
                                            <span class="icon fcp-search1"></span>
                                            <span class="label hidden">Search</span>
                                        </a>
                                    </li>
                                    <li class="pe-3">
                                        @auth
                                            <a href="{{ route('show_wishlist') }}" class="nav-link to-wishlist">
                                                <span class="icon fcp-heart-o"></span>
                                                <span class="label hidden">Wishlist</span>
                                            </a>
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="nav-link to-wishlist">
                                                <span class="icon fcp-heart-o"></span>
                                                <span class="label hidden">Wishlist</span>
                                            </a>
                                        @endguest
                                    </li>
                                    <li class="nav-hover pe-3">
                                        <a href="#" class="nav-link hover-toggle" data-bs-toggle="dropdown">
                                            <span class="icon fcp-user-o"></span>
                                            <span class="label hidden">Account</span>
                                        </a>
                                        <ul class="hover-menu">
                                            <li>
                                                <a href="/account/dashboard" class="dropdown-item">Account</a>
                                            </li>

                                            @guest
                                                <li>
                                                    <a href="{{ route('login') }}" class="dropdown-item">Wishlist</a>
                                                </li>
                                            @endguest

                                            @auth
                                                <li>
                                                    <a href="{{ route('show_wishlist') }}" class="dropdown-item">Wishlist</a>
                                                </li>
                                            @endauth

                                            @guest
                                                <li>
                                                    <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                                                </li>
                                            @endguest

                                            @auth
                                                <li>
                                                    <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </li>
                                    <li class="nav-hover">
                                        <a href="#" class="nav-link action add-to-cart">
                                            <span class="icon fcp-purchase">
                                                @auth
                                                    @if($count > 0)
                                                        <span id="countCart" class="count">{{ $count }}</span>
                                                    @endif
                                                @endauth
                                            </span>
                                            <span class="label hidden">Cart</span>
                                        </a>
                                        <div class="hover-menu cart-content">
                                            @guest
                                                Please, login to shopping.
                                            @endguest

                                            @auth

                                                @if($count <= 0)
                                                    No item in shopping cart.
                                                @else
                                                    <div class="group-content">
                                                        <div class="title">
                                                            <h4>Item: {{ $count }}</h4>
                                                        </div>

                                                        <div class="cart-items items">
                                                            @foreach($carts as $cart)
                                                                <div class="row cart-details item">
                                                                    <div class="cart-image">
                                                                        @if($cart->product->product_image == null)
                                                                            <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                                                        @else
                                                                            <img src="public/assets/images/products/{{ $cart->product->product_image }}" width="100px"/>
                                                                        @endif
                                                                    </div>
                                                                    <div class="cart-info">
                                                                        <p class="item-name">{{ $cart->product->product_name }}</p>
                                                                        <p class="item-price">

                                                                            @if($cart->product->product_discount == null)
                                                                                <span class="label">Price: </span>
                                                                                <span class="value">RM{{ $cart->price }}</span>

                                                                            @else
                                                                                <span class="label">Old Price: </span>
                                                                                <span class="old-price">RM{{ $cart->product->product_old_price }}</span>
                                                                                <span class="label">Price: </span>
                                                                                <span class="value">RM{{ $cart->price }}</span>
                                                                            @endif

                                                                        </p>
                                                                        <p class="item-qty">
                                                                            <span class="label">Qty: </span>
                                                                            <span class="price">{{ $cart->quantity }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="row total-section-group">
                                                            @php $total = 0 @endphp
                                                            @foreach($carts as $cart)
                                                                @php
                                                                    $total += $cart->price * $cart->quantity
                                                                @endphp
                                                            @endforeach

                                                            <div class="total-section">
                                                                <p class="total">
                                                                    <span class="label">Total: </span>
                                                                    <span class="value">${{ $total }}</span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row text-center">
                                                            <div class="checkout">
                                                                <a href="{{ route('checkout') }}" style="text-decoration: none">
                                                                    <button class="btn btn-full btn-primary">Go to Checkout</button>
                                                                </a>
                                                                <a href="{{ route('cart') }}" class="action view-cart">
                                                                    View shopping cart
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endauth
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        @include('frontend.layout.block.search.search_product')--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="header">--}}
{{--    <a href="./" class="logo">--}}
{{--        <img src="assets/logo.png" alt="">--}}
{{--    </a>--}}
{{--    <div id="menu">--}}
{{--        <div class="item {{ (request()->segment(1) == '') ? 'active' : '' }}">--}}
{{--            <a href="./">Home Page</a>--}}
{{--        </div>--}}
{{--        <div class="item {{ (request()->segment(1) == 'home') ? 'active' : '' }}">--}}
{{--            <a href="./home">All Product</a>--}}
{{--        </div>--}}
{{--        <div class="item {{ (request()->segment(1) == 'blogs') ? 'active' : '' }}">--}}
{{--            <a href="./blogs">Blog</a>--}}
{{--        </div>--}}
{{--        <div class="item {{ (request()->segment(1) == 'contact') ? 'active' : '' }}">--}}
{{--            <a href="./contact">Contact</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div id="actions">--}}
{{--        <div class="item header-action">--}}
{{--            <a href="{{ route('show_wishlist') }}" class="action account">--}}
{{--                <span class="icon fcp-heart-o">--}}
{{--                    <span class="count"></span>--}}
{{--                </span>--}}
{{--                <span class="label hidden">Wishlist</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="item header-action">--}}
{{--            <a href="" class="action account">--}}
{{--                <span class="icon fcp-user-o"></span>--}}
{{--                <span class="label hidden">Account</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-content">--}}
{{--                <ul class="account-links items">--}}
{{--                    <li class="item">--}}
{{--                        <a href="account/dashboard" class="account-link register-link">Account</a>--}}
{{--                    </li>--}}
{{--                    <li class="item">--}}
{{--                        <a href="{{ route('login') }}" class="account-link login-link">Login</a>--}}
{{--                    </li>--}}
{{--                    <li class="item">--}}
{{--                        <a href="{{ route('register') }}" class="account-link register-link">Register</a>--}}
{{--                    </li>--}}
{{--                    <li class="item">--}}
{{--                        <a href="{{ route('logout') }}" class="account-link register-link">Logout</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="item header-action">--}}
{{--            <a href="" class="action add-to-cart">--}}
{{--                <span class="icon fcp-purchase">--}}
{{--                    <span class="count">{{ count((array) session('cart')) }}</span>--}}
{{--                </span>--}}
{{--                <span class="label hidden">Cart</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="">--}}
{{--            <div class="row total-header-section">--}}
{{--                @php $total = 0 @endphp--}}
{{--                @foreach((array) session('cart') as $id => $details)--}}
{{--                    @php--}}
{{--                        $total += $details['price'] * $details['quantity']--}}
{{--                    @endphp--}}
{{--                @endforeach--}}

{{--                <div class="total-section">--}}
{{--                    <p class="total">--}}
{{--                        <span class="label">Total: </span>--}}
{{--                        <span class="value">$ {{ $total }}</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            @if(session('cart'))--}}
{{--                @foreach(session('cart') as $id => $details)--}}
{{--                    <div class="row cart-details item">--}}
{{--                        <div class="cart-image">--}}
{{--                            <p>image</p>--}}
{{--                        </div>--}}
{{--                        <div class="cart-info">--}}
{{--                            <p class="item-name">{{ $details['product_name'] }}</p>--}}
{{--                            <p class="item-price">--}}
{{--                                <span class="label">Price: </span>--}}
{{--                                <span class="value">{{ $details['price'] }}</span>--}}
{{--                            </p>--}}
{{--                            <p class="item-qty">--}}
{{--                                <span class="label">Qty: </span>--}}
{{--                                <span class="price">{{ $details['quantity'] }}</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}

{{--            <div class="row">--}}
{{--                <div class="checkout">--}}
{{--                    <a href="{{ route('cart') }}" class="action view-all">--}}
{{--                        View all--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
