@extends('backend.layout.master')

@section('title', 'New Product')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('post_product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="actions">
                <button type="submit" class="action create">Save</button>
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
                <input type="text" placeholder="Name" id="product_name" class="form-controll" name="product_name" autofocus onchange="getValue()"/>
                @if($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">SKU<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="" id="product_sku" class="form-controll" name="product_sku" />
                @if($errors->has('product_sku'))
                    <span class="text-danger">{{ $errors->first('product_sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Status:</label>
                <select class="" id="product_status" name="product_status">
                    <option value="1">In Stock</option>
                    <option value="0">Out of Stock</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Quantity<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="" id="product_qty" class="form-controll" name="product_qty" />
                @if($errors->has('product_qty'))
                    <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Price<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="" id="product_price" class="form-controll" name="product_price" />
                @if($errors->has('product_price'))
                    <span class="text-danger">{{ $errors->first('product_price') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Discount:</label>
                <input type="text" placeholder="" id="product_discount" class="form-controll" name="product_discount" onchange="getDiscount()"/><span class="label discount">  (%)</span>
            </div>
            <div class="form-group">
                <label class="label">Old Price:</label>
                <input type="text" placeholder="" id="product_old_price" class="form-controll" name="product_old_price" readonly/>
            </div>
            <div class="form-group">
                <label class="label">Weight:</label>
                <input type="text" placeholder="" id="product_weight" class="form-controll" name="product_weight" /><span class="label pound">  Pound(s)</span>
            </div>
            <div class="form-group">
                <label class="label">Category<span class="btn-require">*</span>:</label>
                <select id="select_category" name="category_id" class="form-controll">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="label">Brand<span class="btn-require">*</span>:</label>
                <select id="select_brand" name="brand_id" class="form-controll">
                        <option value="">None</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Label:</label>
                <select id="select_feature" name="product_label" class="form-controll">
                    <option value="">None</option>
                    <option value="new">New</option>
                    <option value="sale">Sale</option>
                    <option value="hot">Hot</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Features<span class="btn-require">*</span>:</label>
                <select id="select_feature" name="product_feature" class="form-controll">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Product Image:</label>
                <input type="file" value="" name="product_image" id="product_image" class="form-control">
            </div>
            <div class="form-group">
                <label class="label">Short Description:</label>
                <textarea class="ckeditor form-control" name="product_short_description" id="content" cols="30" rows="5" placeholder=""></textarea>
            </div>
            <div class="form-group">
                <label class="label">Description:</label>
                <textarea class="ckeditor form-control" name="product_description" id="product_description" cols="30" rows="10" placeholder=""></textarea>
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
