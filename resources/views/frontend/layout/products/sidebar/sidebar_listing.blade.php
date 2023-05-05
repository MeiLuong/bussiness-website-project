<div class="filter-groups filter-items items">

    <form action="">
        <div class="filter-item item categories box border-bottom">
            <div class="actions" style="padding: 10px 0;">
                <a href="/home" class="btn btn-secondary">Reset Filter</a>
            </div>
            <h4 class="title box-label text-uppercase d-flex align-items-center">Categories</h4>
            <ul id="inner-box" class="filter-categories content collapse mt-2 mr-1">
                @foreach($categories as $category)

                    <li class="filter-category item">
                        <a href="{{ $category->category_name }}" class="filter-link category-link link-theme {{ (request()->segment(1) == 'categoryName') ? 'active' : '' }}">{{ $category->category_name }}</a>
                    </li>

                @endforeach
            </ul>
        </div>

        <div class="filter-item item brands box border-bottom">
                <h4 class="title box-label text-uppercase d-flex align-items-center">Brands</h4>
                <ul id="inner-box2" class="filter-brands content">
                    @foreach($brands as $brand)
                        <li class="filter-brand item">
                            <label for="">{{ $brand->brand_name }}</label>
                            <input type="checkbox"
                                   {{ (request("$brand"[$brand->id] ?? '') == 'on' ? 'checked' : '') }}
                                   id="brand-{{ $brand->id }}"
                                   name="brand[{{ $brand->id }}]"
                                   onchange="this.form.submit();">
                            <span class="checkmark"></span>
                        </li>
                    @endforeach
                </ul>
            </div>

        <div class="filter-item item prices box border-bottom">
            <h4 class="title box-label text-uppercase d-flex align-items-center">Prices</h4>
            <div class="filter-prices content flter-range-wrap">
                <div class="range-slider">
                    <div class="price-input">
                        <input type="text" id="minamount" name="price_min">
                        <input type="text" id="maxamount" name="price_max">
                    </div>
                </div>

                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="999"
                data-min-value="{{ str_replace('$', '', request('price_min')) }}" data-max-value="{{ str_replace('$', '', request('price_max')) }}">
                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-small filter-btn">Filter</button>
        </div>
    </form>

</div>
