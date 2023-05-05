<div class="search-popup">
    <div class="search-popup-container">

        <form role="search" method="get" class="search-form" action="home">
            <input type="search" id="search-form" class="search-field" placeholder="Search..." value="{{ request('search') }}" name="search" />
            <button type="submit" class="search-submit">
                <span class="icon fcp-search1"></span>
            </button>
        </form>

        <h5 class="cat-list-title">Browse Categories</h5>

        <ul class="cat-list">
            <li class="cat-list-item">
                <a href="/home" title="All Products">All Product</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Eyewear">Eyewear</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Contact Lenses">Contact Lenses</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Brands">Brands</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Tap & try">Tap & try</a>
            </li>
        </ul>

    </div>
</div>
