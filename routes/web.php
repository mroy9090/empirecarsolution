<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InsertVehicleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;

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


Auth::routes();



// route generates about login and home page

Route::get('/', [AdminController::class, 'start'])->name('home');
Route::get('about', [AdminController::class, 'about'])->name('about');
Route::get('contact', [AdminController::class, 'contact'])->name('contact');
Route::get('cart', [AdminController::class, 'cart'])->name('cart');
Route::get('checkout', [AdminController::class, 'checkout'])->name('checkout');





Route::get('/home', [HomeController::class, 'index']);




// route generates about category page


Route::get('category', [CategoryController::class, 'category'])->name('category');
Route::post('category/add', [CategoryController::class, 'insertCategory'])->name('add_category');
Route::get('category/delete/{category_id}', [CategoryController::class, 'categoryDelete'])->name('category_delete');
Route::get('category/restore/{category_id}', [CategoryController::class, 'categoryRestore'])->name('category_restore');
Route::get('category/forcedelete/{category_id}', [CategoryController::class, 'categoryForceDelete'])->name('category_force_delete');



// route generates about add vehicle page
Route::get('add/vehicle', [InsertVehicleController::class, 'add_vehicle'])->name('add_vehicle');
Route::post('add/vehicle/information', [InsertVehicleController::class, 'insert_vehicle_info'])->name('insert_vehicle_info');


// route generates about manage vehicle page
Route::get('manage/in/vehicle', [InsertVehicleController::class, 'manage_in_vehicle'])->name('manage_in_vehicle');
Route::get('delete/manage/vehicle/{user_id}', [InsertVehicleController::class, 'delete_manage_vehicle'])->name('delete_manage_vehicle');
Route::get('manage/out/vehicle', [InsertVehicleController::class, 'manage_out_vehicle'])->name('manage_out_vehicle');
Route::get('download/vehicle/invoice/{user_id}', [InsertVehicleController::class, 'download_pdf'])->name('download_pdf');

// route generates about contact info page
Route::post('contact/us', [AdminController::class, 'contact_info'])->name('contact_info');






// route generates about contact info page
Route::get('check/out/vehicle/{user_id}', [InsertVehicleController::class, 'check_out'])->name('check_out');








// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END





