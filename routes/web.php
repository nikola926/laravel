<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\About;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

	$brands = DB::table('brands')->get();
	$sliders = DB::table('sliders')->get();

    return view('home', compact('brands', 'sliders'));
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact'); 

Route::get('/about', [About::class, 'index'])->middleware('check')->name('about'); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Categories
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'pDelete']);


//Brand Controller
Route::get('/brand/all/', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


//Multipic Controller
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'AddMultiImg'])->name('multi.add');





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

	// $users = User::all();
	// $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');


//Log Controller
Route::get('/user/logout', [LogController::class, 'Logout'])->name('user.logout');



////////HOME ROUTE

//Slider Controller
Route::get('/slider/all', [HomeController::class, 'AllSlider'])->name('slider.all');
Route::get('/slider/add', [HomeController::class, 'AddSlider'])->name('slider.add');
Route::post('/slider/store', [HomeController::class, 'StoreSlider'])->name('slider.store');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);







