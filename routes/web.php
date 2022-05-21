<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/', function () {

    $brands=\App\Models\Brand::get();

    return view('home',compact('brands'));
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/aboutme', function () {
    return 'about';
})->name('about');



Route::get('/contact',[ContactController::class,'index'])->middleware('age');

//Category Controller
Route::get('/category/all',[CategoryController::class,'AllCategory'])->name('all.category');
Route::get('/category/edit/{id}',[CategoryController::class,'EditCategory'])->name('Edit.category');
Route::get('/category/softdelete/{id}',[CategoryController::class,'SoftDelete'])->name('Soft.Delete');
Route::get('/category/restore/{id}',[CategoryController::class,'SoftRestore'])->name('Soft.Restore');
Route::get('/category/forcedelete/{id}',[CategoryController::class,'forceDelete'])->name('p.Delete');
Route::post('/category/add',[CategoryController::class,'AddCategory'])->name('store.category');
Route::post('/category/update/{id}',[CategoryController::class,'UpdateCategory'])->name('update.category');


//Brand Controller
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'EditBrand'])->name('Edit.Brand');
Route::post('/brand/update/{id}',[BrandController::class,'UpdateBrand'])->name('update.brand');
Route::get('/brand/forcedelete/{id}',[BrandController::class,'forceDelete'])->name('brand.Delete');

//Slider Controller
Route::get('/home/slider',[HomeController::class,'homeSlider'])->name('home.slider');
Route::post('/slider/add',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'Editslider'])->name('Edit.slider');
Route::post('/slider/update/{id}',[HomeController::class,'UpdateSlider'])->name('update.slider');

//multi image Controller
Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.image');
Route::get('/multi/forcedelete/{id}',[BrandController::class,'forceDeleteMultipic'])->name('multi.forceDelete');
Route::post('/store/images',[BrandController::class,'StoreImages'])->name('store.images');


Route::get('/user/logout',[ContactController::class,'UserLogout'])->name('user.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
      /*  $users = User::all();*/
      /*  $users = DB::table('users')->get();*/
        return view('admin.index');
    })->name('dashboard');
});
