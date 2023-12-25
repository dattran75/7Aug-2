<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategroriesController;
use App\Http\Controllers\BrandController    ;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleController;


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

Route::middleware('checkLogin')->group(function () {

Route::get('/',[UserController::class,'index'])->middleware('checkAdmin');
Route::post('/addLoaiTaiKhoan',[UserController::class,'TaoLoaiTaiKhoan']);
Route::post('/editLoaiTaiKhoan',[UserController::class,'editLoaiTaiKhoan']);
Route::post('/deleteLoaiTaiKhoan',[UserController::class,'deleteLoaiTaiKhoan']);  
Route::post('/createUser',[UserController::class,'createUser']); 
Route::get('/logout',[UserController::class,'logout']);
Route::post('/doiEmail',[UserController::class,'doiEmail']);
Route::post('/switchUser',[UserController::class,'switchUser']);
Route::post('/XoaTaiKhoan',[UserController::class,'XoaTaiKhoan']);
});
Route::controller(CategroriesController::class)->group(function () {
    Route::get('/loai-sp', 'index');
    Route::post('/loai-sp', 'store');
    Route::post('/xoa-loai-sp', 'destroy');
    Route::post('/sua-loai-sp', 'update');
    Route::post('/khoi-phuc-loaisp', 'restore');
    Route::post('/Switch-loaisp', 'Switch');

});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class,'index'])->name('index');
    Route::post('/', [ProductController::class,'addProduct']);
    Route::post('/edit', [ProductController::class,'edit']);
    Route::post('/deleteProduct', [ProductController::class,'deleteProduct']);  
    Route::post('/submitEditProduct', [ProductController::class,'update']);
    Route::get('brands', [BrandController::class,'index']);
    Route::post('brands', [BrandController::class,'store']);
    Route::post('editBrands', [BrandController::class,'update'])->name('editBrands');
    Route::post('deleteBrands', [BrandController::class,'destroy']);
    Route::post('restoreBrands', [BrandController::class,'restore']);
    Route::post('SwitchBrands', [BrandController::class,'Switch']);

});
Route::get('/loginGoogle',[GoogleController::class,'redirect']);
Route::get('auth/google/call-back', [GoogleController::class, 'callBack']);

Route::post('/checkLogin',[UserController::class,'checkLogin']);
Route::get('/DangNhap',[UserController::class,'DangNhap']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
   
});




   



