<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
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
    return view('welcome');
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
Route::post('/category/add',[CategoryController::class,'AddCategory'])->name('store.category');
Route::post('/category/update/{id}',[CategoryController::class,'UpdateCategory'])->name('update.category');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
      /*  $users = User::all();*/
        $users = DB::table('users')->get();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
