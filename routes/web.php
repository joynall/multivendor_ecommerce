<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;

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
    return view('frontend.index');
});


Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    
    
    }); // Gorup Milldeware End

    
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin all route

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    
});
Route::get('/admin/login',[AdminController::class, 'AdminLogin']); 



//Vendor all route

Route::middleware(['auth','role:vendor'])->group(function(){
    Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[vendorController::class, 'vendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
});
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register'); 





Route::middleware(['auth','role:admin'])->group(function() {

    // Brand All Route 
   Route::controller(BrandController::class)->group(function(){
       Route::get('/all/brand' , 'AllBrand')->name('all.brand');
       Route::get('/add/brand' , 'AddBrand')->name('add.brand');
       Route::post('/store/brand' , 'StoreBrand')->name('store.brand');
       Route::get('/edit/brand/{id}' , 'EditBrand')->name('edit.brand');
       Route::post('/update/brand' , 'UpdateBrand')->name('update.brand');
       Route::get('/delete/brand/{id}' , 'DeleteBrand')->name('delete.brand');
   
   });


     // Category All Route 
     Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category' , 'AllCategory')->name('all.category');
        Route::get('/add/category' , 'AddCategory')->name('add.category');
        Route::post('/store/category' , 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}' , 'EditCategory')->name('edit.category');
        Route::post('/update/category' , 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');
    
    });
     // SubCategory All Route 
        Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/Subcategory' , 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/Subcategory' , 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/Subcategory' , 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/Subcategory/{id}' , 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/Subcategory' , 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/Subcategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
    
    });
   
    // Vendor Active and Inactive All Route 
        Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor' , 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor' , 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve' , 'ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}' , 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve' , 'InActiveVendorApprove')->name('inactive.vendor.approve');

    });


     // Product All Route 
    Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product' , 'AllProduct')->name('all.product');
    Route::get('/add/product' , 'AddProduct')->name('add.product');


    });




   
   
   }); // End Middleware
