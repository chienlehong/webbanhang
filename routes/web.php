<?php

use App\Http\Controllers\Admin\Category\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CouponController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WishlistController;

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('pages.index');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/password/change', [HomeController::class, 'changePassword'])->name('password.change');
Route::post('/password/update', [HomeController::class, 'updatePassword'])->name('password.update');

Route::get('/user/logout', [HomeController::class, 'Logout'])->name('user.logout');

Route::get('admin/home', [AdminController::class, 'index']);
Route::get('admin', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [LoginController::class, 'login']);
Route::get('/admin/Change/Password', [AdminController::class, 'ChangePassword'])->name('admin.password.change');
Route::post('/admin/password/update', [AdminController::class, 'Update_pass'])->name('admin.password.update');
Route::get('admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

///Category
Route::get('admin/categories', [CategoryController::class, 'category'])->name('categories');
Route::post('admin/store/category', [CategoryController::class, 'storecategory'])->name('store.category');
Route::get('edit/category/{id}', [CategoryController::class, 'Editcategory'])->name('admin.edit.category');
Route::post('update/category', [CategoryController::class, 'UpdateCategory'])->name('admin.update.category');
Route::get('delete/category/{id}', [CategoryController::class, 'DeleteCategory'])->name('admin.delete.category');


//Sub category
Route::get('admin/sub/category', [SubCategoryController::class, 'SubCategory'])->name('sub.categories');
Route::post('admin/store/subcat', [SubCategoryController::class, 'SubCategoryStore'])->name('store.subcategory');
Route::get('admin/sub/category', [SubCategoryController::class, 'SubCategory'])->name('sub.categories');
Route::get('admin/edit/subcat/{id}', [SubCategoryController::class, 'EditSubCategory'])->name('edit.subcategory');
Route::post('admin/update/subcat', [SubCategoryController::class, 'UpdateSubCategory'])->name('update.subcategory');
Route::get('admin/delete/subcat/{id}', [SubCategoryController::class, 'DeleteSubCategory'])->name('delete.subcategory');

//Brand
Route::get('admin/brands', [BrandController::class, 'Brand'])->name('admin.brand');
Route::post('admin/store/brand', [BrandController::class, 'StoreBrand'])->name('admin.brand.store');
Route::get('admin/edit/brand/{id}', [BrandController::class, 'EditBrand'])->name('admin.brand.edit');
Route::post('admin/update/brand', [BrandController::class, 'UpdateBrand'])->name('admin.brand.update');
Route::get('admin/delete/brand/{id}', [BrandController::class, 'DeleteBrand'])->name('admin.brand.delete');

//Coupon
Route::get('admin/coupon', [CouponController::class, 'Coupon'])->name('admin.coupon');
Route::post('admin/store/coupon', [CouponController::class, 'StoreCoupon'])->name('admin.coupon.store');
Route::get('admin/edit/coupon/{id}', [CouponController::class, 'EditCoupon'])->name('admin.coupon.edit');
Route::post('admin/update/coupon', [CouponController::class, 'UpdateCoupon'])->name('admin.coupon.update');
Route::get('admin/delete/coupon/{id}', [CouponController::class, 'DeleteCoupon'])->name('admin.coupon.delete');

//Newslaters
Route::get('admin/newslater', [CouponController::class, 'Newslater'])->name('admin.newslaters');
Route::get('delete/sub/{id}', [CouponController::class, 'DeleteSub']);


Route::controller(ProductController::class)->group(function () {
    Route::get('admin/product/all', [ProductController::class, 'index'])->name('all.product');
    Route::get('admin/product/add', [ProductController::class, 'create'])->name('add.product');
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('store.product');
    //For show sub category with ajax
    Route::get('get/subcategory/{category_id}', [ProductController::class, 'GetSubCat']);
    Route::get('inactive/product/{id}', [ProductController::class, 'InactiveProduct'])->name('inactive.product');
    Route::get('active/product/{id}', [ProductController::class, 'ActiveProduct'])->name('active.product');
    Route::get('delete/product/{id}', [ProductController::class, 'DeleteProduct'])->name('delete.product');

    Route::get('view/product/{id}', [ProductController::class, 'ViewProduct'])->name('view.product');

    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('admin/product/update', [ProductController::class, 'update'])->name('update.product');
    Route::post('update/product/photo', [ProductController::class, 'UpdateProductPhoto'])->name('update.photo');
});


Route::controller(PostController::class)->group(function () {
    Route::get('blog/category/list', [PostController::class, 'BlogCatList'])->name('add.blog.categorylist');
    Route::post('admin/store/blog', [PostController::class, 'BlogCatStore'])->name('store.blog.category');
    Route::get('delete/blogcategory/{id}', [PostController::class, 'DeleteBlogCat']);
    Route::get('edit/blogcategory/{id}', [PostController::class, 'EditBlogCat'])->name('edit.blogcategory');
    Route::post('update/blogcategory', [PostController::class, 'UpdateBlogCat'])->name('update.blogcategory');

    Route::get('admin/add/post', [PostController::class, 'Create'])->name('add.blogpost');
    Route::get('admin/all/post', [PostController::class, 'index'])->name('all.blogpost');

    Route::post('admin/store/post', [PostController::class, 'store'])->name('store.post');
    Route::get('delete/post/{id}', [PostController::class, 'DeletePost']);
    Route::get('edit/post/{id}', [PostController::class , 'EditPost']);

    Route::post('update/post/{id}', [PostController::class , 'UpdatePost']);
});

Route::controller(WishlistController::class)->group(function(){
    Route::get('/add/wishlist/{id}' , [WishlistController::class , 'addWishlist']);
});

Route::get('/add/to/cart/{id}' , [CartController::class , 'addCart']);
Route::get('check' , [CartController::class , 'check']);
Route::get('product/cart' , [CartController::class , 'ShowCart'])->name('show.cart');

Route::get('product/details/{id}/{product_name}' , [ControllersProductController::class , 'ProductView']);
Route::post('cart/product/add/{id}' , [ControllersProductController::class , 'AddToCart']);
Route::get('remove/cart/{rowId}' , [CartController::class , 'RemoveCart']);
Route::post('update/cart/item', [CartController::class,'UpdateCart'])->name('update.cartitem');
Route::get('cart/product/view/{id}' , [CartController::class , 'ViewProduct']);
Route::post('insert/into/cart/', [CartController::class, 'insertCart'])->name('insert.into.cart');

Route::get('user/checkout' , [CartController::class , 'checkout'])->name('user.checkout');
Route::get('user/wishlist' , [CartController::class , 'wishlist'])->name('user.wishlist');
Route::post('user/apply/coupon' , [CartController::class , 'Coupon'])->name('apply.coupon');
Route::get('coupon/remove/',[CartController::class, 'CouponRemove'])->name('coupon.remove');



//Blog post route
Route::get('blog/post' , [BlogController::class , 'blog'])->name('blog.post');
Route::get('language/english', [BlogController::class,'English'])->name('language.english');
Route::get('language/vn', [BlogController::class ,'Vn'])->name('language.vn');

Route::get('blog/single/{id}', [BlogController::class ,'BlogSingle']);




//Productdetail Page
Route::get('products/{id}' , [ControllersProductController::class , 'ProductsView']);
Route::get('allcategory/{id}' , [ControllersProductController::class , 'CategoryView']);

//Payment Step
Route::get('payment/page', [CartController::class, 'PaymentPage'])->name('payment.step');
Route::post('user/payment/process/', [PaymentController::class,'Payment'])->name('payment.process');
Route::post('user/stripe/charge/', [PaymentController::class , 'StripeCharge'])->name('stripe.charge');
Route::post('user/oncash/charge/', [PaymentController::class , 'OnCash'])->name('oncash.charge');

//Admin Order Route
Route::get('admin/pending/order' , [OrderController::class , 'NewOrder'])->name('admin.neworder');
Route::get('admin/view/order/{id}', [OrderController::class ,'ViewOrder']);
Route::get('admin/payment/accept/{id}', [OrderController::class,'PaymentAccept']);
Route::get('admin/payment/cancel/{id}', [OrderController::class,'PaymentCancel']);
Route::get('admin/accept/payment', [OrderController::class , 'AcceptPayment'])->name('admin.accept.payment');
Route::get('admin/cancel/order', [OrderController::class, 'CancelOrder'])->name('admin.cancel.order');
Route::get('admin/process/payment', [OrderController::class , 'ProcessPayment'])->name('admin.process.payment');
Route::get('admin/success/payment', [OrderController::class , 'SuccessPayment'])->name('admin.success.payment');
Route::get('admin/delevery/process/{id}', [OrderController::class , 'DeleveryProcess']);
Route::get('admin/delevery/done/{id}', [OrderController::class , 'DeleveryDone']);


//SEO
Route::get('admin/seo', [OrderController::class , 'seo'])->name('admin.seo');
Route::post('admin/seo/update', [OrderController::class , 'UpdateSeo'])->name('update.seo');

// Order Tracking Route
Route::post('order/traking', [FrontController::class , 'OrderTraking'])->name('order.tracking');

//Report Order
Route::get('admin/today/order', [ReportController::class,'TodayOrder'])->name('today.order');
Route::get('admin/today/delivery', [ReportController::class,'TodayDelivery'])->name('today.delivery');
Route::get('admin/this/month', [ReportController::class , 'ThisMonth'])->name('this.month');
Route::get('admin/search/report', [ReportController::class , 'Search'])->name('search.report');

Route::post('admin/search/by/year', [ReportController::class , 'SearchByYear'])->name('search.by.year');
Route::post('admin/search/by/month', [ReportController::class , 'SearchByMonth'])->name('search.by.month');

Route::post('admin/search/by/date', [ReportController::class , 'SearchByDate'])->name('search.by.date');


// Admin Role Routes 

Route::get('admin/all/user', [UserRoleController::class , 'UserRole'])->name('admin.all.user');

Route::get('admin/create/admin', [UserRoleController::class , 'UserCreate'])->name('create.admin');
Route::post('admin/store/admin', [UserRoleController::class , 'UserStore'])->name('store.admin');
Route::get('delete/admin/{id}', [UserRoleController::class , 'UserDelete']);
Route::get('edit/admin/{id}', [UserRoleController::class , 'UserEdit']);

Route::post('admin/update/admin', [UserRoleController::class , 'UserUpdate'])->name('update.admin');

// Admin Site Setting Route 
Route::get('admin/site/setting', [SettingController::class , 'SiteSetting'])->name('admin.site.setting');

Route::post('admin/sitesetting', [SettingController::class , 'UpdateSiteSetting'])->name('update.sitesetting');

 // Return Order Route

 Route::get('success/list/', [PaymentController::class , 'SuccessList'])->name('success.orderlist');
 Route::get('request/return/{id}', [PaymentController::class , 'RequestReturn']);
 Route::get('admin/return/request/', [ReturnController::class , 'ReturnRequest'])->name('admin.return.request');

Route::get('admin/approve/return/{id}', [ReturnController::class , 'ApproveReturn']);
Route::get('admin/all/return/', [ReturnController::class , 'AllReturn'])->name('admin.all.return');

// Order Stock Route 
Route::get('admin/product/stock', [UserRoleController::class , 'ProductStock'])->name('admin.product.stock');


Route::post('store/newslater', [FrontController::class, 'StoreNewslater'])->name('store.newslater');



/// Contact page Routes

Route::get('contact/page', [ContactController::class , 'Contact'])->name('contact.page');
Route::post('contact/form', [ContactController::class , 'ContactForm'])->name('contact.form');

Route::get('admin/all/message', [ContactController::class , 'AllMessage'])->name('all.message');

// Search Route
Route::post('product/search', [CartController::class , 'Search'])->name('product.search');


//Socail Route
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('callback/google', [SocialController::class, 'handleCallback']);
