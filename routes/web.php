<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\BangController;
use App\Http\Controllers\UserController;


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

//BACKEND ->admin

Route::get('/login',[AdminController::class,'index'])->name('login');
Route::post('/submit-login',[AdminController::class,'login'])->name('admin.submit_login');

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('',[AdminController::class,'showDashboard'])->name('admin.index');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    // Đơn
    Route::prefix('Don')->group(function() {
        Route::get('',[DonController::class,'all_don'])
        ->name('admin.all_category');

        Route::get('add_NH',[DonController::class,'add_don_NH'])->name('admin.new_category');
        Route::get('add_KD',[DonController::class,'add_don_KD'])->name('admin.new_don_KD');
        Route::get('add_GPHI',[DonController::class,'add_don_GPHI'])->name('admin.new_don_GPHI');
        Route::get('detail/{don_id}',[DonController::class,'don_detail'])->name('admin.don_detail');
        
        Route::post('/save_NH',[DonController::class,'save_don_NH'])
        ->name('save_don_NH');

        Route::post('/save_KD',[DonController::class,'save_don_KD'])
        ->name('save_don_KD');

        Route::post('/save_GPHI',[DonController::class,'save_don_GPHI'])
        ->name('save_don_GPHI');

        Route::get('/edit_NH/{don_id}',[DonController::class,'edit_category_product'])
        ->name('admin.edit_category');

        Route::get('/edit_KD/{don_id}',[DonController::class,'edit_don_KD'])
        ->name('admin.edit_don_KD');

        Route::get('/edit_GPHI/{don_id}',[DonController::class,'edit_don_GPHI'])
        ->name('admin.edit_don_GPHI');

        Route::post('/update/{don_id},{congTy_id},{image}',[DonController::class,'update_don_NH'])
        ->name('admin.update_category'); 

        Route::post('/update_KD/{don_id},{congTy_id},{image}',[DonController::class,'update_don_KD'])
        ->name('admin.update_don_KD'); 

        Route::post('/update_GPHI/{don_id},{congTy_id}',[DonController::class,'update_don_GPHI'])
        ->name('admin.update_don_GPHI'); 


        Route::get('/delete/{don_id},{congTy_id}',[DonController::class,'delete_category_product'])
        ->name('admin.delete_category');   

        Route::get('/unactive/{category_id}',[DonController::class,'unactive_category_product'])
        ->name('admin.unactive_category');

        Route::get('/active/{category_id}',[DonController::class,'active_category_product'])
        ->name('admin.active_category');
        Route::get('xuatExcel',[DonController::class,'print_to_excel'])->name('admin.print_don_to_excel');
    });

    // Bằng
    Route::prefix('Bang')->group(function() {
        Route::get('',[BangController::class,'all_bang'])
        ->name('admin.all_brand');
        Route::get('/add',[BangController::class,'add_brand_product'])
        ->name('admin.add_brand');
        Route::post('/save',[BangController::class,'save_brand_product'])
        ->name('admin.save_brand');
        Route::get('/edit/{bang_id},{don_id}',[BangController::class,'edit_brand_product'])
        ->name('admin.edit_brand');
        Route::post('/update/{bang_id},{don_id}',[BangController::class,'update_brand_product'])
        ->name('admin.update_brand'); 
        Route::get('/delete/{bang_id},{don_id}',[BangController::class,'delete_brand_product'])
        ->name('admin.delete_brand');
       
        Route::get('detail/{bang_id},{don_id}',[BangController::class,'bang_detail'])->name('admin.bang_detail');
        Route::get('xuatExcel',[BangController::class,'print_to_excel'])->name('admin.print_to_excel');
    });
    
   
});

//User
Route::get('/',[UserController::class,'index'])->name('user.index');
Route::prefix('user')->group(function() {
    Route::prefix('Don')->group(function() {
        Route::get('',[UserController::class,'all_don'])
        ->name('user.all_don');
        Route::get('detail/{don_id}',[UserController::class,'don_detail'])->name('user.don_detail');
        
       
        Route::get('xuatExcel',[UserController::class,'don_print_to_excel'])->name('user.don_print_to_excel');
    });
    Route::prefix('Bang')->group(function() {
        Route::get('',[UserController::class,'all_bang'])
        ->name('user.all_bang');
        Route::get('detail/{bang_id},{don_id}',[UserController::class,'bang_detail'])->name('user.bang_detail');
        
       
        Route::get('xuatExcel',[UserController::class,'bang_print_to_excel'])->name('user.bang_print_to_excel');
    });
});
