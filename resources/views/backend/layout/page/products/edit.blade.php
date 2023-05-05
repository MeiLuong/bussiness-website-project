@extends('backend.layout.master')

@section('title', 'Edit Product')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_product', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="actions">
                <button type="submit" class="action create">Update</button>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label class="label">Product Name<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $product->product_name }}" placeholder="Name" id="product_name" class="form-controll" name="product_name" autofocus onchange="getValue()"/>
                @if($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">SKU<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $product->product_sku }}" placeholder="" id="product_sku" class="form-controll" name="product_sku" />
                @if($errors->has('product_sku'))
                    <span class="text-danger">{{ $errors->first('product_sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Status:</label>
                <select class="" id="product_status" name="product_status">
                    <option value="1" @if($product->product_status == 1) selected @endif>In Stock</option>
                    <option value="0" @if($product->product_status == 0) selected @endif>Out of Stock</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Quantity<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $product->product_qty }}" placeholder="" id="product_qty" class="form-controll" name="product_qty" />
                @if($errors->has('product_qty'))
                    <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Price<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $product->product_price }}" placeholder="" id="product_price" class="form-controll" name="product_price" />
                @if($errors->has('product_price'))
                    <span class="text-danger">{{ $errors->first('product_price') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Discount:</label>
                <input type="text" value="{{ $product->product_discount }}" placeholder="" id="product_discount" class="form-controll" name="product_discount" onchange="getDiscount()" /><span class="label discount">  (%)</span>
            </div>

            <div class="form-group">
                <label class="label">Old Price:</label>
                <input type="text" placeholder="" id="product_old_price" class="form-controll" name="product_old_price" readonly/>
            </div>

            <div class="form-group">
                <label class="label">Weight:</label>
                <input type="text" value="{{ $product->product_weight }}" placeholder="" id="product_weight" class="form-controll" name="product_weight" /><span class="label pound">  Pound(s)</span>
            </div>
            <div class="form-group">
                <label class="label">Category<span class="btn-require">*</span>:</label>
                <select id="category_id" name="category_id" class="form-controll">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="label">Brand<span class="btn-require">*</span>:</label>
                <select id="select_brand" name="brand_id" class="form-controll">
                        <option value="" @if($product->brand_id == '') selected @endif>None</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Label:</label>
                <select id="select_feature" name="product_label" class="form-controll">
                    <option value="" @if($product->product_label == '') selected @endif>None</option>
                    <option value="new" @if($product->product_label == 'new') selected @endif>New</option>
                    <option value="sale" @if($product->product_label == 'sale') selected @endif>Sale</option>
                    <option value="hot" @if($product->product_label == 'hot') selected @endif>Hot</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Features<span class="btn-require">*</span>:</label>
                <select id="select_feature" name="product_feature" class="form-controll">
                    <option value="0" @if($product->product_feature == 0) selected @endif>No</option>
                    <option value="1" @if($product->product_feature == 1) selected @endif>Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Image:</label>
                <input type="file" value="" name="product_image" id="product_image" class="form-control">
                @if($product->product_image == null)
                    <img src="assets/images/products/product-default-list-350.jpeg" width="200px"/>
                @else
                    <img src="public/assets/images/products/{{ $product->product_image }}" width="200px"/>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Short Description:</label>
                <textarea class="ckeditor form-control" name="product_short_description" id="content" cols="30" rows="5" placeholder="">
                    {{ $product->product_short_description }}
                </textarea>
            </div>
            <div class="form-group">
                <label class="label">Description:</label>
                <textarea class="ckeditor form-control" name="product_description" id="product_description" cols="30" rows="10" placeholder="">
                    {{ $product->product_description }}
                </textarea>
            </div>

        </form>
    </div>

    <script>
        function getValue(){

            var titleValue = document.getElementById('product_name').value;
            var valueConver = titleValue.replace(/\s+/g, '-').toLowerCase();

            document.getElementById('product_sku').value = valueConver;
        }

        function getDiscount() {
            var currentPrice = document.getElementById('product_price').value;
            var discountPrice = document.getElementById('product_discount').value;

            const discount = parseFloat((100 - discountPrice)/100);
            const sumDiscount = parseFloat(currentPrice * discount);

            document.getElementById('product_price').value = sumDiscount.toFixed(2);
            document.getElementById('product_old_price').value = currentPrice;
        }

    </script>
@endsection
