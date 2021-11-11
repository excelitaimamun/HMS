<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AccountantController;

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
    return view('welcome');
});


// Admin Login View
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


// Admin View 
Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/dashboard', function () {
    return view('super_admin.home');
})->name('dashboard');


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Accountant Start
Route::prefix('accountant')->group(function () {
    Route::get('/view', [AccountantController::class, 'AccountantView'])->name('all.accountant'); 
    Route::post('/add', [AccountantController::class, 'AccountantStore'])->name('accountant.add'); 
    // Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('edit.brand'); 
    // Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('update.brand');
    // Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('delete.brand'); 
     
  });// Admin Brand All Route Group End 
