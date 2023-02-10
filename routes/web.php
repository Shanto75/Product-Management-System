<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/admin/dashbord');
});

Route::get('getuser', [AdminController::class, 'getuser']);

Route::get('login', [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'check']);
Route::get('error', [LoginController::class, 'error']);

//admin profile
// Route::get('admin/login', [AdminController::class, 'login']);
// Route::post('admin/login', [AdminController::class, 'check']);

Route::get('admin/adduser', [AdminController::class, 'adduserindex']);
Route::post('admin/adduser', [AdminController::class, 'adduser']);

Route::prefix('admin')->middleware('adminauth')->group(function () {
    Route::get('/logout', [AdminController::class, 'logout']);

    Route::get('/dashbord', [AdminController::class, 'index']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::get('/edituser/{id}', [AdminController::class, 'edituser']);
    Route::post('/edituser/{id}', [AdminController::class, 'saveuser']);
    Route::post('/deleteAdmin', [AdminController::class, 'deleteAdmin']);
    Route::get('/settings', [AdminController::class, 'settings']);
    Route::post('/settings', [AdminController::class, 'savesettings']);

    Route::get('/adminlist', [AdminController::class, 'adminlist']);
    Route::get('/sellerlist', [AdminController::class, 'sellerlist']);
    Route::get('/buyerlist', [AdminController::class, 'buyerlist']);
    Route::get('/riderlist', [AdminController::class, 'riderlist']);
    Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
    
    Route::get('/userprofile/{id}', [AdminController::class, 'userprofile']);
    Route::get('/bid', [AdminController::class, 'bid']);
    Route::get('/product-list', [AdminController::class, 'product']);
});

//buyer profile
// Route::get('buyer/login', [BuyerController::class, 'login']);
// Route::post('buyer/login', [BuyerController::class, 'check']);

Route::prefix('buyer')->middleware('buyerauth')->group(function () {
    Route::get('/logout', [BuyerController::class, 'logout']);

    Route::get('/dashbord', [BuyerController::class, 'index']);
    Route::get('/profile', [BuyerController::class, 'profile']);
    Route::get('/edit-profile', [BuyerController::class, 'editprofile']);
    Route::post('/edit-profile', [BuyerController::class, 'saveprofile']);

    Route::get('/buy-product', [BuyerController::class, 'buyproduct']); 
    Route::get('/get_product_details/{id}', [BuyerController::class, 'get_product_details']);
    Route::post('/bidProduct', [BuyerController::class, 'bid_product']);
    Route::get('/my-bid', [BuyerController::class, 'mybid']); 

    Route::get('/delete-my-bid/{id}', [BuyerController::class, 'deletemybid']); 
});

//seller profile
// Route::get('seller/login', [SellerController::class, 'login']);
// Route::post('seller/login', [SellerController::class, 'check']);

Route::prefix('seller')->middleware('sellerauth')->group(function () {
    Route::get('/logout', [SellerController::class, 'logout']);

    Route::get('/dashbord', [SellerController::class, 'index']);
    Route::get('/profile', [SellerController::class, 'profile']);
    Route::get('/edit-profile', [SellerController::class, 'editprofile']);
    Route::post('/edit-profile', [SellerController::class, 'saveprofile']);

    Route::get('/add-product', [SellerController::class, 'addproduct']);
    Route::post('/add-product', [SellerController::class, 'saveproduct']);

    Route::get('/product-list', [SellerController::class, 'productlist']);
    Route::get('/view-product/{id}', [SellerController::class, 'viewproduct']);
    Route::get('/edit-product/{id}', [SellerController::class, 'editproduct']);
    Route::get('/delete-product/{id}', [SellerController::class, 'deleteproduct']);
    Route::post('/update-product/{id}', [SellerController::class, 'update']);

    Route::get('/bid', [SellerController::class, 'getbids']);
    Route::post('/bid', [SellerController::class, 'bid']);

    Route::get('/view_bids/{id}', [SellerController::class, 'view_bids']);

});
