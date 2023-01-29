<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Search;
use App\Http\Controllers\Contact;


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
    return view('layouts.landingPage');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/reservation', function () {
    return view('reservation');
});

Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/login', function () {
//     return view('welcome');
// });


// Route::get('/', [AuthenticatedSessionController::class, 'create'])
//                 ->name('login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/admin', function () {
//     return view('layouts.admin');
// })->middleware(['auth'])->name('admin');

Route::get('/landingPage', function () {
    return view('layouts.landingPage');
})->name('landingPage');


Route::middleware(['auth' , 'admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/' , [AdminController::class , 'index'])->name('index');
    Route::resource('/category' , CategoryController::class);
    Route::post('/category/{category}' , [CategoryController::class , 'update'])->name('cat-update');
    Route::get('/category/{category}' , [CategoryController::class , 'destroy'])->name('cat-destroy');
    Route::resource('/menu' , MenuController::class);
    Route::resource('/reservation' , ReservationController::class);
    Route::resource('/table' , TableController::class);
    Route::resource('/user' , UserController::class);
    Route::get('/user/{user}' , [UserController::class , 'destroy'])->name('user-destroy');
    Route::get('/user/{user}' , [UserController::class , 'update'])->name('user-update');
});

Route::post('/search' , [Search::class , 'search'])->name('search');





require __DIR__.'/auth.php';



