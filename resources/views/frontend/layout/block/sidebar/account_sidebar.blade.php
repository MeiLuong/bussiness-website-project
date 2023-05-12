<div class="sidebar account-sidebar">
    <ul class="nav-items items">
        <li class="nav-item item"><a href="/account/dashboard" class="link-theme">My Account</a></li>
        <li class="nav-item item"><a href="{{ route('edit_infor', \Illuminate\Support\Facades\Auth::user()->id) }}" class="link-theme">Edit Information</a></li>
        <li class="nav-item item"><a href="{{ route('show_wishlist') }}" class="link-theme">My Wishlist</a></li>
        <li class="nav-item item"><a href="{{ route('myOrder') }}" class="link-theme">My Orders</a></li>
    </ul>
</div>

