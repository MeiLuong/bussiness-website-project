<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//home page
Route::get('/', [Frontend\HomeController::class, 'redirect']);
Route::get('/', [Frontend\HomeController::class, 'index']);

//account
Route::get('account/login', [Frontend\UserController::class, 'index'])->name('login');
Route::get('/account/dashboard', [Frontend\UserController::class, 'account']);
Route::post('account/login/postLogin', [Frontend\UserController::class, 'login'])->name('postLogin');
Route::get('account/register', [Frontend\UserController::class, 'register'])->name('register');
Route::post('account/register/postRegister', [Frontend\UserController::class, 'registerSave'])->name('postRegister');
Route::get('account/logout', [Frontend\UserController::class, 'logOut'])->name('logout');
Route::get('account/edit/{id}', [Frontend\UserController::class, 'edit'])->name('edit_infor');
Route::patch('account/update/{id}', [Frontend\UserController::class, 'update'])->name('update_infor');
Route::get('account/changePassword', [Frontend\UserController::class, 'changePassword'])->name('change_password');
Route::post('account/changePassword', [Frontend\UserController::class, 'updatePassword'])->name('update_password');
Route::get('account/my-order', [Frontend\CheckoutController::class, 'myOrder'])->name('myOrder');
Route::get('account/my-order/{id}', [Frontend\CheckoutController::class, 'orderDetail'])->name('orderDetail');


//products page
Route::prefix('home')->group(function () {
    //product details page
    Route::get('/product/{id}', [Frontend\ProductDetailsController::class, 'productDetails']);

    //post review
    Route::post('/product/{id}', [Frontend\ProductDetailsController::class, 'postReview']);

    Route::get('/', [Frontend\ProductDetailsController::class, 'index']);

    Route::get('/{categoryName}', [Frontend\ProductDetailsController::class, 'category'])->name('categoryName');
    Route::get('/sale', [Frontend\ProductDetailsController::class, 'productSale'])->name('sale');
});

// shopping cart
Route::get('cart', [Frontend\ShoppingCartController::class, 'cart'])->name('cart');
Route::post('cart/add-to-cart/{id}', [Frontend\ShoppingCartController::class, 'addToCart'])->name('add_to_cart');
Route::post('update_cart', [Frontend\ShoppingCartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart/{id}', [Frontend\ShoppingCartController::class, 'remove'])->name('remove_from_cart');

//wishlist
Route::post('wishlist', [Frontend\WishListController::class, 'toWishlist'])->name('add_to_wishlist');
Route::get('wishlist/remove', [Frontend\WishListController::class, 'remove'])->name('remove_wishlist');
Route::get('wishlist/show', [Frontend\WishListController::class, 'show'])->name('show_wishlist');

//checkout page
Route::get('checkout', [Frontend\CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout', [Frontend\CheckoutController::class, 'addOrder'])->name('add-order');


//blogs
Route::get('/blogs', [Frontend\BlogController::class, 'list'])->name('blogs');
Route::get('/blogs/{id}', [Frontend\BlogController::class, 'details'])->name('details');


//admmin website
Route::get('admin', [Backend\AdminController::class, 'index', \Illuminate\Support\Facades\Auth::user() == null]);
Route::post('admin', [Backend\AdminController::class, 'login'])->name('postLoginAd');
Route::get('admin/dashboard', [Backend\DashboardController::class, 'index']);
Route::get('admin/logout', [Backend\AdminController::class, 'logOut'])->name('logoutAdmin');



//account
Route::get('admin/customers', [Backend\CustomerController::class, 'customers']);
Route::get('admin/customers/create', [Backend\CustomerController::class, 'addCustomer'])->name('customerCreate');
Route::post('admin/customers/postCustomer', [Backend\CustomerController::class, 'customerSave'])->name('postCustomer');
Route::get('admin/customers/edit/{id}', [Backend\CustomerController::class, 'edit'])->name('edit_customer');
Route::patch('admin/customers/{id}', [Backend\CustomerController::class, 'update'])->name('update_customer');
Route::delete('admin/customers/delete/{id}', [Backend\CustomerController::class, 'delete'])->name('delete_customer');


Route::get('admin/adminer', [Backend\AdminController::class, 'adminer']);
Route::get('admin/adminer/create', [Backend\AdminController::class, 'add'])->name('create_adminer');
Route::post('admin/adminer/postAdminer', [Backend\AdminController::class, 'save'])->name('post_adminer');
Route::get('admin/adminer/edit/{id}', [Backend\AdminController::class, 'edit'])->name('edit_adminer');
Route::patch('admin/adminer/{id}', [Backend\AdminController::class, 'update'])->name('update_adminer');
Route::delete('admin/adminer/delete/{id}', [Backend\AdminController::class, 'delete'])->name('delete_adminer');
Route::get('admin/changePassword', [Backend\AdminController::class, 'changePassword'])->name('change_passwordAD');
Route::post('admin/changePassword', [Backend\AdminController::class, 'updatePassword'])->name('update_passwordAD');


//category
Route::get('admin/category', [Backend\CategoryController::class, 'category'])->name('category');
Route::get('admin/category/create', [Backend\CategoryController::class, 'add'])->name('create_category');
Route::post('admin/category/postCategory', [Backend\CategoryController::class, 'save'])->name('post_category');
Route::get('admin/category/edit/{id}', [Backend\CategoryController::class, 'edit'])->name('edit_category');
Route::put('admin/category/{id}', [Backend\CategoryController::class, 'update'])->name('update_category');
Route::delete('admin/category/delete/{id}', [Backend\CategoryController::class, 'delete'])->name('delete_category');


//brand
Route::get('admin/brand', [Backend\BrandController::class, 'index'])->name('brands');
Route::get('admin/brand/create', [Backend\BrandController::class, 'add'])->name('create_brand');
Route::post('admin/brand/postBrand', [Backend\BrandController::class, 'save'])->name('post_brand');
Route::get('admin/brand/edit/{id}', [Backend\BrandController::class, 'edit'])->name('edit_brand');
Route::put('admin/brand/{id}', [Backend\BrandController::class, 'update'])->name('update_brand');
Route::delete('admin/brand/delete/{id}', [Backend\BrandController::class, 'delete'])->name('delete_brand');

//banner
Route::get('admin/banner', [Backend\BannerController::class, 'index'])->name('banners');
Route::get('admin/banner/create', [Backend\BannerController::class, 'add'])->name('create_banner');
Route::post('admin/banner/postBrand', [Backend\BannerController::class, 'save'])->name('post_banner');
Route::get('admin/banner/edit/{id}', [Backend\BannerController::class, 'edit'])->name('edit_banner');
Route::put('admin/banner/{id}', [Backend\BannerController::class, 'update'])->name('update_banner');
Route::delete('admin/banner/delete/{id}', [Backend\BannerController::class, 'delete'])->name('delete_banner');

//products
Route::get('admin/product', [Backend\ProductController::class, 'index'])->name('products');
Route::get('admin/product/create', [Backend\ProductController::class, 'add'])->name('create_product');
Route::post('admin/product/create/postProduct', [Backend\ProductController::class, 'save'])->name('post_product');
Route::get('admin/product/edit/{id}', [Backend\ProductController::class, 'edit'])->name('edit_product');
Route::put('admin/product/{id}', [Backend\ProductController::class, 'update'])->name('update_product');
Route::delete('admin/product/delete/{id}', [Backend\ProductController::class, 'delete'])->name('delete_product');
Route::get('admin/product/search', [Backend\ProductController::class, 'search'])->name('searchAD');



//blogs
Route::get('admin/blogs', [Backend\BlogController::class, 'index'])->name('blogs');
Route::get('admin/blogs/blog/create', [Backend\BlogController::class, 'add'])->name('create_blog');
Route::post('admin/blogs/blog/post', [Backend\BlogController::class, 'save'])->name('post_blog');
Route::get('admin/blogs/blog/edit/{id}', [Backend\BlogController::class, 'edit'])->name('edit_blog');
Route::put('admin/blogs/blog/{id}', [Backend\BlogController::class, 'update'])->name('update_blog');
Route::delete('admin/blogs/blog/delete/{id}', [Backend\BlogController::class, 'delete'])->name('delete_blog');

//pages
Route::get('page/{id}', [Backend\PageController::class, 'view'])->name('page');
Route::get('admin/pages', [Backend\PageController::class, 'index'])->name('index');
Route::get('admin/page/create', [Backend\PageController::class, 'add'])->name('create_page');
Route::post('admin/page/post', [Backend\PageController::class, 'save'])->name('post_page');
Route::get('admin/page/edit/{id}', [Backend\PageController::class, 'edit'])->name('edit_page');
Route::patch('admin/page/{id}', [Backend\PageController::class, 'update'])->name('update_page');
Route::delete('admin/page/delete/{id}', [Backend\PageController::class, 'delete'])->name('delete_page');

//checkout
Route::get('/admin/orders', [Backend\CheckoutController::class, 'orders'])->name('orders');
Route::get('/admin/new-orders', [Backend\CheckoutController::class, 'new'])->name('news');
Route::get('/admin/orders/invoices', [Backend\CheckoutController::class, 'invoices'])->name('invoices');
Route::get('/admin/orders/shipments', [Backend\CheckoutController::class, 'shipments'])->name('shipments');
Route::get('/admin/orders/cancels', [Backend\CheckoutController::class, 'cancels'])->name('cancels');
Route::get('admin/orders/edit/{id}', [Backend\CheckoutController::class, 'edit'])->name('edit_order');
Route::post('admin/orders/{id}', [Backend\CheckoutController::class, 'update'])->name('update_order');









